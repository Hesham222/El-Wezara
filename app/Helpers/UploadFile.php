<?php
namespace App\Helpers;
//use Admin\Models\ProductImage;
//use App\Models\File;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class UploadFile
{

    //upload single file
    public static function UploadSinglelFile($file,$path)
    {
        //get only name without ext
        $name =  preg_replace('/\..+$/', '', $file->getClientOriginalName());
        //new file name with random value
        $filename = $name . rand() . '.' . $file->getClientOriginalExtension();
        $filename = str_replace(' ','',$filename);
        // save to storage/app/path as the new $filename
        return  $file->storeAs($path, $filename,'public');
    }


    //Remove single file from storage
    public static function RemoveFile($file=null)
    {
        if(file_exists(public_path().DIRECTORY_SEPARATOR.'storage'.DIRECTORY_SEPARATOR.$file)) {
            unlink(public_path().DIRECTORY_SEPARATOR.'storage'.DIRECTORY_SEPARATOR.$file);
        }
    }


    //upload Multi files
//    public static function UploadMultiFiles($files,$pathName,$model_type,$model_id)
//    {
//        foreach ($files as $file)
//        {
//            $OrignalName =  $file->getClientOriginalName();
//            //get only name without ext
//            $name     =  preg_replace('/\..+$/', '', $file->getClientOriginalName());
//            //new file name with random value
//            $filename = $name . rand() . '.' . $file->getClientOriginalExtension();
//            //get new path or uploded file
//            $path     = $file->storeAs($pathName, $filename,'public');
//            //get size uploded file
//            $size     = $file->getSize();
//            // save files in files modules
//            ProductImage::create(['product_id'=>$model_id,'image'=>$path]);
//        }
//    }

    //upload multi images


    public static function UploadMainImage($files,$pathName)
    {
        foreach ($files as $file)
        {
            $name     =  preg_replace('/\..+$/', '', $file->getClientOriginalName());
            //new file name with random value
            $filename = $name .  '.' . $file->getClientOriginalExtension();

            $path     = $file->storeAs($pathName, $filename,'public');
            //get size uploded file
            $size     = $file->getSize();

        }
    }




    //Remove multiple file from storage and File Model
//    public static function RemoveMultiFiles($model_type,$model_id)
//    {
//        $files  = ProductImage::where('product_id',$model_id)->get();
//        foreach ($files as $file)
//        {
//            ProductImage::where('id', $file->id)->delete();
//            self::RemoveFile($file->image);
//        }
//    }

}
