<?php

namespace App\Traits;

trait ContentRules {
   
    public function banner()
    {
        return [
            'title'         => 'required',
            'heading'       => 'required',
            'sub_heading'   => 'required',
            'payment_heading'=> 'required',
            'image'         => 'image|mimes:jpg,jpeg,png|max:2048',
            'image_size'    => 'required_with:image'
        ];
    }
    public function banner_subcontent()
    {
        return [
            'title'         => 'required',
            'image'         => 'image|mimes:jpg,jpeg,png|max:2048',
        ];
    }


    public function service()
    {
        return  [
            'title'              => 'required',
            'heading'            => 'required',

        ];
    }
    public function service_subcontent()
    {
        return [
            'icon'               => 'required',
            'title'              => 'required',
            'details'            => 'required'
        ];
    }

    public function offer()
    {
        return [
            'title'              => 'required',
            'heading'            => 'required',
        ];
    }
    public function how()
    {
        return [
            'title'              => 'required',
            'heading'            => 'required',
            'sub_heading'        => 'required',
            'image'              => 'image|mimes:jpg,jpeg,png|max:2048',
            'image_size'         => 'required_with:image'
        ];
    }

    public function how_subcontent()
    {
        return [
            'icon'               => 'required',
            'title'              => 'required',
            'details'            => 'required'
        ];
    }


    public function feature()
    {
         return [
            'heading'            => 'required',
            'feature_text'       => 'required',
            'btn_name'           => 'required',
            'btn_url'            => 'required'
         ];
    }
    public function feature_subcontent()
    {
        return [
            'feature'              => 'required',
        ];
    }

    public function faq()
    {
        return [
            'title'              => 'required',
            'heading'            => 'required',
            'sub_heading'        => 'required',
            'btn_name'           => 'required',
            'btn_url'            => 'required'
        ];
    
    }

    public function faq_subcontent()
    {
        return [
            'question'           => 'required',
            'answer'             => 'required'
        ];
    }

    public function testimonial()
    {
        return [
            'title'              => 'required',
            'heading'            => 'required',
        ];
    }

    public function testimonial_subcontent()
    {
        return [
            'image'              => 'image|mimes:jpg,jpeg,png,PNG|max:2048',
            'image_size'         => 'required_with:image',
            'name'               => 'required',
            'quote'              => 'required'
        ];
    }

    public function blog()
    {
         return [
            'title'              => 'required',
            'heading'            => 'required',
            'sub_heading'        => 'required'
        ];
    }

    public function sponsor_subcontent()
    {
        return [
            'image'              => 'image|mimes:jpg,jpeg,png,PNG|max:2048',
            'image_size'         => 'required_with:image'
        ];
    }
    public function social_subcontent()
    {
        return [
            'icon'               => 'required',
            'url'                => 'required',
        ];
    }
    public function policies_subcontent()
    {
        return [
            'lang'               => 'required',
            'title'              => 'required',
            'description'        => 'required',
        ];
    }

    public function contact()
    {
        return [
            'title'              => 'required',
            'heading'            => 'required',
            'sub_heading'        => 'required',
            'phone'              => 'required',
            'email'              => 'required|email',
            'address'            => 'required'
       ];
    }
    public function login()
    {
        return [
            'first_heading'      => 'required',
            'first_sub_heading'  => 'required',
            'second_heading'     => 'required',
            'second_sub_heading' => 'required',
       ];
    }
    public function register()
    {
        return [
            'first_heading'      => 'required',
            'first_sub_heading'  => 'required',
            'second_heading'     => 'required',
            'second_sub_heading' => 'required',
       ];
    }

}
