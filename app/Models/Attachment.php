<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Backpack\CRUD\CrudTrait;
use Auth;
// use Novius\Backpack\CRUD\ModelTraits\UploadableFile;

class Attachment extends Model
{
    use CrudTrait;
    // use UploadableFile;

    /*
    |--------------------------------------------------------------------------
    | GLOBAL VARIABLES
    |--------------------------------------------------------------------------
    */

    protected $table = 'attachments';
    protected $primaryKey = 'id';
    // public $timestamps = false;
    protected $guarded = ['id'];
    protected $casts = [
        'fisical_name' => 'array',
    ];
    // protected $fillable = ['title', 'fisical_name'];
    // protected $hidden = [];
    // protected $dates = [];

    /*
    |--------------------------------------------------------------------------
    | FUNCTIONS
    |--------------------------------------------------------------------------
    */
    // public function uploadableFiles(): array
    //     {
    //         return [
    //             ['name' => 'fisical_name']
    //         ];
    //     }

    /*
    |--------------------------------------------------------------------------
    | RELATIONS
    |--------------------------------------------------------------------------
    */
    public function documents()
    {
        return $this->belongsToMany('App\Models\Document','attachment_document','attachment_id','document_id');
    }

    /*
    |--------------------------------------------------------------------------
    | SCOPES
    |--------------------------------------------------------------------------
    */

    /*
    |--------------------------------------------------------------------------
    | ACCESORS
    |--------------------------------------------------------------------------
    */

    /*
    |--------------------------------------------------------------------------
    | MUTATORS
    |--------------------------------------------------------------------------
    */
    // public function setFisicalNameAttribute($value)
    // {
    //     $attribute_name = "fisical_name";
    //     $disk = "local";
    //     $destination_path = "local";
    //     // dd('pluto');
    //     // $this->uploadPdfToDisk($value, $attribute_name, $disk, $destination_path);
    //     $this->uploadMultipleAttachmentsToDisk($value, $attribute_name, $disk, $destination_path);
    //
    //     // OH YEAH BABY!!!
    //     return $this->attributes[$attribute_name];
    // }
    //
    // public function uploadMultipleAttachmentsToDisk($value, $attribute_name, $disk, $destination_path)
    // {
    //     $request = \Request::instance();
    //
    //     $attribute_value = (array) $this->{$attribute_name};
    //     $files_to_clear = $request->get('clear_'.$attribute_name);
    //     // dd($request,$attribute_value,$files_to_clear);
    //     // if a file has been marked for removal,
    //     // delete it from the disk and from the db
    //     if ($files_to_clear) {
    //         $attribute_value = (array) $this->{$attribute_name};
    //         foreach ($files_to_clear as $key => $filename) {
    //             \Storage::disk($disk)->delete($filename);
    //             $attribute_value = array_where($attribute_value, function ($value, $key) use ($filename) {
    //                 return $value != $filename;
    //             });
    //         }
    //     }
    //     // dd($request,$attribute_name);
    //     // if a new file is uploaded, store it on disk and its filename in the database
    //     if ($request->hasFile($attribute_name)) {
    //         foreach ($request->file($attribute_name) as $file) {
    //             if ($file->isValid()) {
    //                 // 1. Generate a new file name
    //                 $originalName = $file->getClientOriginalName();
    //                 // dd($originalName);
    //                 $new_file_name = md5($file->getClientOriginalName().time()).'.'.$file->getClientOriginalExtension();
    //
    //                 // 2. Move the new file to the correct path
    //                 $file_path = $file->storeAs($destination_path, $new_file_name, $disk);
    //
    //                 // 3. Add the public path to the database
    //                 // $attachment = new Attachment;
    //                 // $attachment->title = $originalName;
    //                 // $attachment->original_name = $originalName;
    //                 // $attachment->fisical_name = $new_file_name;
    //                 // $attachment->disk = $disk;
    //                 // $attachment->path = $destination_path;
    //                 // $attachment->type = 'test';
    //                 // $attachment->size = 0;
    //                 // $attachment->extraction_id = null;
    //                 // $attachment->version = 0;
    //                 // $attachment->created_by = Auth::user()->id;
    //                 // $attachment->save();
    //                 // dump('fatto');
    //                 $attribute_value[] = $file_path;
    //                 $data[] = $new_file_name;
    //             }
    //         }
    //     }
    //
    //     $this->attributes[$attribute_name] = json_encode($attribute_value);
    //     $this->datifile = $data;
    //     // dd($data);
    //
    // }
}
