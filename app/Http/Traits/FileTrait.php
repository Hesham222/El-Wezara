<?php
namespace App\Http\Traits;
use App\Models\File;

trait FileTrait {

    public static function storeMultipleFiles($files, $pathFolder, $modelType, $modelId)
    {
        foreach ($files as $file)
        {
            $originalName = $file->getClientOriginalName();
            $size         = $file->getSize();
            $path         = $file->store($pathFolder, 'public');
            File::create([
                'name'        => $originalName,
                'size'        => $size,
                'path'        => $path,
                'model_type'  => $modelType,
                'model_id'    => $modelId,
            ]);
        }
        return 1;
    }
    public static function storeMultiple($files, $pathFolder)
    {
        $path = array();
        foreach ($files as $file)
        {

            $originalName   = $file->getClientOriginalName();
            $size           = $file->getSize();
            $path[]         = $file->store($pathFolder, 'public');

        }
        return $path;
    }
    public static function RemoveMultiFiles($model_type, $model_id)
    {
        $files  = File::where('model_id', $model_id)->where('model_type', $model_type)->get();
        foreach ($files as $file)
        {
            File::where('id', $file->id)->delete();
            self::RemoveSingleFile($file->path);
        }
    }

    public static function storeFile($file, $pathFolder, $modelType, $modelId)
    {
        $originalName = $file->getClientOriginalName();
        $size         = $file->getSize();
        $path         = $file->store($pathFolder, 'public');
        File::create([
            'name'        => $originalName,
            'size'        => $size,
            'path'        => $path,
            'model_type'  => $modelType,
            'model_id'    => $modelId,
        ]);
        return 1;
    }

    public static function RemoveFile($id)
    {
        $file  = File::find($id);
        self::RemoveSingleFile($file->path);
        $file->delete();
    }

    public static function storeSingleFile($file, $pathFolder)
    {
        if(!$file)
            return null;
        $path   = $file->store($pathFolder, 'public');
        return $path;
    }

    public static function RemoveSingleFile($file = null)
    {
        if(file_exists(public_path().DS().'storage'.DS().$file))
            unlink(public_path().DS().'storage'.DS().$file);
        else
            return 0;
    }


}
