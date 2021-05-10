<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Generalsetting extends Model
{
    use HasFactory;
    public $timestamps = false;
      /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */

    protected $casts = ['cookie'=>'object','api_settings'=>'object']; 
    protected $fillable = ['kyc_trade_limit','kyc_offer_limit','is_admin_loader', 'header_logo','footer_logo','favicon', 'website_loader','dashboard_loader','breadcumb','title', 'smtp_host','smtp_port','smtp_user','mail_encryption','smtp_pass','from_email','mail_type','from_name','error_banner','theme_color','is_tawk','tawk_id','is_verify','is_cookie','cookie_btn_text','cookie_text','maintenance','menu','allowed_email','contact_no','recaptcha_key','recaptcha_secret' ];

    

} 
