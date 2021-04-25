<?php
namespace App\Http\Controllers\Admin;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Models\PaymentGateway;
use App\Http\Controllers\Controller;

class PaymentGatewayController extends Controller
{
    public function index()
    {
        $gateways = PaymentGateway::paginate(16);
        return view('admin.payment.index',compact('gateways'));
    }

    public function store(Request $request)
    {
        $request->validate( ['name' => 'required|unique:payment_gateways','currency_id'=>'required','currency_id.*'=>'required']);
       
        $data = new PaymentGateway();
        $data->name = $request->name;
        $data->slug = Str::slug($request->name);
        $data->status = $request->status ? 1 : 0;
        $data->currency_id =  $request->currency_id;
        $data->save();
        return back()->with('success','New payment gateway added');
        
    }

    //*** POST Request
    public function update(Request $request, PaymentGateway $gateway)
    {
        $request->validate( ['name' => 'required|unique:payment_gateways,name,'.$gateway->id,'currency_id'=>'required','currency_id.*'=>'required']);
        $gateway->name = $request->name;
        $gateway->slug = Str::slug($request->name);
        $gateway->status = $request->status ? 1 : 0;
        $gateway->currency_id =  $request->currency_id;
        $gateway->save();
        return back()->with('success','Payment gateway updated');

    }

}

