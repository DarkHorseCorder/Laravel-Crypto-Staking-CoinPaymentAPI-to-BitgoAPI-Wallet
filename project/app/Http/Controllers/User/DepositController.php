<?php
namespace  App\Http\Controllers\User;

use App\Models\Wallet;
use App\Models\Deposit;
use App\Models\Currency;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\DepositAddress;
use App\Models\Generalsetting;


class DepositController extends Controller {


    public function index()
    {
        $wallets = Wallet::where('user_id',auth()->id())->with('curr')->get();
        return view('user.wallets',[
            'wallets' => $wallets
        ]);
    }
   
    public function generateAddress(Request $request)
    {
        try {
            $api = Generalsetting::value('api_settings');
            $curr = Currency::whereCode($request->code)->firstOrFail();
            $public_key  =  @$api->public_key  ?? '';
            $private_key =  @$api->private_key ?? '';
            
            $req['version']  = 1; 
            $req['cmd']      = "get_callback_address"; 
            $req['currency'] = $request->code;
            $req['ipn_url']  = route('coinpayment.notify');
            $req['key']      = $public_key; 
            $req['format']   = 'json';
            
            $post_data = http_build_query($req, '', '&'); 
            $hmac = hash_hmac('sha512', $post_data, $private_key); 
            
            $ch = curl_init('https://www.coinpayments.net/api.php'); 
            curl_setopt($ch, CURLOPT_FAILONERROR, TRUE); 
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE); 
            curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0); 
            curl_setopt($ch, CURLOPT_HTTPHEADER, array('HMAC: '.$hmac)); 
            curl_setopt($ch, CURLOPT_POSTFIELDS, $post_data); 
            $data = json_decode(curl_exec($ch));

            DepositAddress::create([ 'user_id' => auth()->id(),'currency_id' => $curr->id,'address'=>$data->result->address]);
            return response()->json(['error'=> $data->error,'result'=> $data->result]);
        } catch (\Exception $e) {
            return response()->json(['error'=> translate('Something went wrong. Please try again later.')]);
        }
    }

    public function existingAddresses($code)
    {
        $curr = Currency::where('code',$code)->firstOrFail();
        $addresses = DepositAddress::where('user_id',auth()->id())->where('currency_id',$curr->id)->paginate(15);
        return view('user.deposit.existing_address',compact('addresses'));
    }
   

    public function dipositHistory()
    {
        $deposits = Deposit::where('user_id',auth()->id())->latest()->paginate(15);
        return view('user.deposit.history',[
            'deposits' => $deposits
        ]);
    }

    public function notify(Request $request)
    {
        try {

            $api = Generalsetting::value('api_settings');
           
            if ($request->status == 100) {
                    
                $depositAddress = DepositAddress::where('address', $request->address)->first();
                if($request->merchant == @$api->merchant_id){
                    $count = Deposit::where('coinpayment_tnx',$request->txn_id)->count();
                    if($count == 0){

                        $curr                   = Currency::find($depositAddress->currency_id);
                        $charge                 = ($request->amount * $curr->charges->deposit_charge / 100);
                        $totalAmount            = $request->amount - $charge;
                        
                        if($totalAmount < 0) $totalAmount = 0;
                        
                        $wallet = Wallet::where('user_id',$depositAddress->user_id)->where('crypto_id',$curr->id)->first();
                        $wallet->balance +=  $totalAmount;
                        $wallet->update();

                        Deposit::create([
                            'user_id'     => $depositAddress->user_id,
                            'currency_id' => $curr->id,
                            'charge'      => $charge,
                            'total_amount'=> $totalAmount,
                            'tnx'         => str_rand(),
                            'coinpayment_tnx' => $request->txn_id
                        ]);
    
                    }
                }
            }
       } catch (\Exception $e) {
            $fpbt = @fopen('coinpayment_response'.time().'.txt', 'w');
            $content = json_encode($request->all() . '<br><br> Error Message : '.$e->getMessage());
            @fwrite($fpbt, json_encode($content,true));
            @fclose($fpbt);
       }
    }
      
}


