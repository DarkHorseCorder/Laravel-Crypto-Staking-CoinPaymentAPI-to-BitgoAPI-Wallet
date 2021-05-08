<?php

namespace App\Http\Resources;

use App\Helpers\Helper;
use App\Models\Page;
use Illuminate\Support\Str;

class PaymentResource {

    // page category update
    public function update($input,$data)
    {
        if(isset($input['pkey'])){
            $input['information'] = json_encode($input['pkey'],true);
        }
        if(isset($input['currency_id'])){
            $input['currency_id'] = json_encode($input['currency_id'],true);
        }
        $data->update($input);
    }

    // page category delete
    public function destroy($page)
    {
        $page->delete();
    }
}


