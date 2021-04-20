<?php

namespace App\Helpers;

use Illuminate\Support\Str;
use Intervention\Image\ImageManagerStatic as Image;

class MediaHelper {

    public function __construct()
    {
       
    }

    // image is file
    // field is database field photo name
    // array is image resize width and height
    public static function handleMakeImage($file,$resize_array=null,$ticket = false)
    {
        $image_name = MediaHelper::imageNameValidation($file);
        $locaion = base_path('../assets/images/');
       
        $fileExts = ['pdf','doc','docx','csv'];
        if($ticket || in_array($file->getClientOriginalExtension(),$fileExts)){
            $locaion = base_path('../assets/ticket/');
            $file->move($locaion, $image_name);
        }else{
            if($resize_array){
                $image = Image::make($file)->resize($resize_array[0], $resize_array[1]);
               if ($file->getClientOriginalExtension() == 'gif') {
                    copy($file->getRealPath(), $locaion.'/'.$image_name);
                }
                else {
                   $image->save($locaion.'/'.$image_name);
                }
            }else{
                $image = Image::make($file);
                 if ($file->getClientOriginalExtension() == 'gif') {
                    copy($file->getRealPath(), $locaion.'/'.$image_name);
                }
                else {
                   $image->save($locaion.'/'.$image_name);
                }
                
            } 
        }

        return $image_name;
    }

    // image is file
    // field is database field photo name
    // array is image resize width and height
    public static function handleUpdateImage($file,$field,$resize_array=null)
    {
        $image_name = MediaHelper::imageNameValidation($file);
        $locaion = base_path('../assets/images/');
       
        if($field && file_exists($locaion.$field)){
            unlink($locaion.$field);
        }
        if($resize_array){
            $image = Image::make($file)->resize($resize_array[0], $resize_array[1]);
            if ($file->getClientOriginalExtension() == 'gif') {
                copy($file->getRealPath(), $locaion.'/'.$image_name);
            }
            else {
               $image->save($locaion.'/'.$image_name);
            }
        }else{
            $image = Image::make($file);
            if ($file->getClientOriginalExtension() == 'gif') {
                copy($file->getRealPath(), $locaion.'/'.$image_name);
            }
            else {
               $image->save($locaion.'/'.$image_name);
            }
        } 
        return $image_name;
    }

    public static function handleDeleteImage($field)
    {
        $locaion = base_path('../assets/images/');
        if($field && file_exists($locaion.$field)){
            unlink($locaion.$field);
        }
    }



    public static function imageNameValidation($image)
    {
       $extension = $image->getClientOriginalExtension();
       $old_name  = explode('.',$image->getClientOriginalName());
       $new_name = rand().time() . '.'. $extension;
       return $new_name;
    }

    public static function ExtensionValidation($image)
    {
       $extension = ['jpg','JPG','jpeg','JPEG','zip','pdg','csv','png','PNG','pdf','doc','docx'];
       $image_extension = $image->getClientOriginalExtension();
       if(in_array($image_extension,$extension)){
           return true;
       }else{
           return false;
       }
    }
}