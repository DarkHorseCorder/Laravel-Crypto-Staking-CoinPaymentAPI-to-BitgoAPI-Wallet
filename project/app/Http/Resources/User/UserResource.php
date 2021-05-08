<?php

namespace App\Http\Resources\User;

use App\Models\Generalsetting;
use App\Models\LoginLogs;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class UserResource {

    public function __construct()
    {
        $this->gs = Generalsetting::findOrFail(1);
    }
    
    // user register
    
    // user login
    public function login($request)
    {
        
    }

    
}


