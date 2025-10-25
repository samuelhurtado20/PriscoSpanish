<?php

namespace App\Http\Controllers;

use PayPal\Rest\ApiContext;
use PayPal\Auth\OAuthTokenCredential;
use PayPal\Api\Amount;
use PayPal\Api\Details;
use PayPal\Api\Item;
use PayPal\Api\ItemList;
use PayPal\Api\Payer;
use PayPal\Api\Payment;
use PayPal\Api\RedirectUrls;
use PayPal\Api\ExecutePayment;
use PayPal\Api\PaymentExecution;
use PayPal\Api\Transaction;

use App\Http\Requests;
use Illuminate\Http\Request;

class PaypalController extends Controller
{
     private $_api_context;
    
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
        // setup PayPal api context
        $paypal_conf = config('paypal');
        $this->_api_context = new ApiContext(new OAuthTokenCredential($paypal_conf['client_id'], $paypal_conf['secret']));
        $this->_api_context->setConfig($paypal_conf['settings']);
    }

 
    public function postPayment(Request $request)
    {
        // referencia en caso de modificaciones
        // https://developer.paypal.com/docs/api/#common-payments-objects

        $payer = new Payer();
        $payer->setPaymentMethod('paypal');

        $seleccion = $request->input('lesson');
        
        $itemseleccionado="";
        //-------------------------------------------------------- Estos articulos hay que generarlos
        //-------------------------------------------------------- Para cada ususario.
        $item_1 = new Item();
        $item_1->setName('20 minutes Test Session') // item name
            ->setCurrency('USD')
            ->setQuantity(1)
            ->setPrice($request->input('lesson1price')); // unit price

        $item_2 = new Item();
        $item_2->setName('60 minutes Learning Session')
            ->setCurrency('USD')
            ->setQuantity(1)
            ->setPrice($request->input('lesson2price'));

        $item_3 = new Item();
        $item_3->setName('5 x 60 minutes Lessons Package')
            ->setCurrency('USD')
            ->setQuantity(1)
            ->setPrice($request->input('lesson3price'));
        
        
        switch($seleccion){
            case 'option2':
                $seleccion = $item_2 ;
                break;
            case 'option3':
                $seleccion = $item_3 ;
                break;
            default:
                $seleccion = $item_1 ;
        }
        

        // add item to list
        $item_list = new ItemList();
        //$item_list->setItems(array($item_1, $item_2, $item_3));
        $item_list->setItems(array($seleccion));
        
        //totalize
        $the_total = 0;
        foreach($item_list->getItems() as $the_item ){
            $the_total += $the_item->getPrice();
        }

        //details
        $details = new Details();
        $details->setShipping(0)
            ->setTax(0)
            ->setSubtotal($the_total);
        
        
        
        $amount = new Amount();
        $amount->setCurrency('USD')
            ->setTotal($the_total)
            ->setDetails($details);

        //create transaction
        $transaction = new Transaction();
        $transaction->setAmount($amount)
            ->setItemList($item_list)
            ->setDescription('Your transaction description');

        $redirect_urls = new RedirectUrls();
        //$redirect_urls->setReturnUrl(url('payment.status'))
        $redirect_urls->setReturnUrl(route('payment.status'))
            ->setCancelUrl(url('reservations'));

        $payment = new Payment();
        $payment->setIntent('Sale')
            ->setPayer($payer)
            ->setRedirectUrls($redirect_urls)
            ->setTransactions(array($transaction));

        try {
            $payment->create($this->_api_context);
        } catch (\PayPal\Exception\PayPalConnectionException $ex) {
            if (config('app.debug')) {
                echo "Exception: " . $ex->getMessage() . PHP_EOL;
                $err_data = json_decode($ex->getData(), true);
                echo $ex->getData() ;
                echo  $ex->getCode() ; // Prints the Error Code
                exit;
            } else {
                die('Some error occur, sorry for inconvenient');
            }
        }

        foreach($payment->getLinks() as $link) {
            if($link->getRel() == 'approval_url') {
                $redirect_url = $link->getHref();
                break;
            }
        }

        // add payment ID to session
        session( [ 'paypal_payment_id' => $payment->getId() ] );

        if(isset($redirect_url)) {
            // redirect to paypal
            return redirect($redirect_url);
        }

        return redirect('reservations')
            ->with('error', 'Unknown error occurred');
    }
    
    
    
    /**
    *
    *
    */
    public function getPaymentStatus(Request $request)
    {
    		//$user = Auth::user();
            // Get the payment ID before session clear
            $payment_id = session('paypal_payment_id');
        
            // clear the session payment ID
            session()->forget('paypal_payment_id');

            if (empty($request->input('PayerID')) || empty($request->input('token'))) {
                return redirect('/reservations')
                    ->with('error', 'Payment failed');
            }

            $payment = Payment::get($payment_id, $this->_api_context);

            // PaymentExecution object includes information necessary 
            // to execute a PayPal account payment. 
            // The payer_id is added to the request query parameters
            // when the user is redirected from paypal back to your site
            $execution = new PaymentExecution();
            $execution->setPayerId($request->input('PayerID'));

            //Execute the payment
            $result = $payment->execute($execution, $this->_api_context);
            
            
            

            echo '<pre>';print_r($result);echo '</pre>';//exit; // DEBUG RESULT, remove it later

            if ($result->getState() == 'approved') { // payment made
               //enviar a la base de datos.
               
               $payment_to_save = new \App\Payment;
               $payment_to_save->txnid = $result->id ;
               $payment_to_save->payment_amount = $result->transactions[0]->amount;
               $payment_to_save->payment_status = $result->state;
               
               //echo "<hr>";
               //var_dump($result->transactions[0]->item_list->getItems()[0]);
               $payment_to_save->itemid = $result->transactions[0]->item_list->getItems()[0]->name;
              // echo "<hr>";
               //var_dump($payment_to_save);
               //exit;
               $payment_to_save->save();
               
                return redirect('/reservations')
                    ->with('success', 'Payment success');
            }
            return redirect('/reservations')
                ->with('error', 'Payment failed');
    }


}//EOC

