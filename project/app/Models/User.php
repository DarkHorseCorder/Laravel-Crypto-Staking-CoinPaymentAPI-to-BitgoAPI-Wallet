<?php

namespace App\Models;

use Laravel\Sanctum\HasApiTokens;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */
    protected $fillable = [
        'name',
        'email',
        'photo',
        'phone',
        'country',
        'city',
        'email_verified',
        'verification_link',
        'address',
        'status',
        'zip',
        'password',
    ];

    protected $casts = ['kyc_info' => 'object'];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    public function transactions()
    {
        return $this->hasMany(Transaction::class)->where('user_type',1);
    }

    public function wallets()
    {
        return $this->hasMany(Wallet::class,'user_id');
    }
    public function trades()
    {
        return $this->hasMany(Trade::class,'offer_user_id');
    }
    public function offers()
    {
        return $this->hasMany(Offer::class,'user_id');
    }
    public function completedTrade()
    {
        return Trade::where(function ($q){
            $q->where('offer_user_id', $this->id)->orWhere('trader_id', $this->id);
        })->where('status',3)->count();
    }


    protected static function boot(){
        parent::boot();
        static::created(function($user){
            LoginLogs::create([
                'user_id' => auth()->id(),
                'ip' => @loginIp()->geoplugin_request,
                'country' => @loginIp()->geoplugin_countryName,
                'city' => @loginIp()->geoplugin_city,
            ]);
        });
    }

  

   

  
    
   

   
}
