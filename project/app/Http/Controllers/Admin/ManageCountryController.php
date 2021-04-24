<?php

namespace App\Http\Controllers\Admin;

use App\Models\Country;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Currency;

class ManageCountryController extends Controller
{
    public function index()
    {
        $search = request('search');
        $countries = Country::when($search,function($q) use($search){$q->where('name','like',"%$search%");})->paginate(16);
        $countryJson = @json_decode(file_get_contents(resource_path('views/admin/partials/countries.json')));
        $currencies = Currency::get();
        return view('admin.country.index',compact('countries','countryJson','currencies','search'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'unique_key'     => 'required|unique:countries',
            'currency'       => 'required|integer'
        ],

        [
            'unique_key.unique' => 'The country is already been added'
        ]);

        try {
            $countryJson = @json_decode(file_get_contents(resource_path('views/admin/partials/countries.json')));
            $data = $countryJson[$request->unique_key];

            $country = new Country();
            $country->unique_key  = $request->unique_key;
            $country->name        = $data->name;
            $country->code        = $data->code;
            $country->dial_code   = $data->dial_code;
            $country->currency_id = $request->currency;
            $country->flag        = $data->image;
            $country->save();
            return back()->with('success','Country has been added');

        } catch (\Throwable $th) {
            return back()->with('error',$th->getMessage());
        }
       
    }

    public function update(Request $request)
    {
        $request->validate([
            'currency'       => 'required|integer'
        ]);

        $country = Country::findOrFail($request->id);
        $country->currency_id = $request->currency;
        $country->update();
        return back()->with('success','Country has been updated');
    }
}
