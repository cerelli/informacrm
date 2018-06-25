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
    public function getExtractionInfo()
    {
        // dd($this->extraction->extracted_by);
        $this->attributes['deleteButton'] = '';
        $this->attributes['unlockButton'] = '';
        $this->attributes['lockButton'] = '';

        // dd($this->extractioned);
        if ( isset($this->attributes['extraction_id'])) {
            //attachment extracted
            $this->attributes['lockButton'] = 'hidden';
            // dd( $this->extractioned->extracted_by );
            if ( $this->extractioned->extracted_by == Auth::user()->id ) {
                // same user
                $this->attributes['unlockButton'] = '';
                $this->attributes['deleteButton'] = '';
                return "<strong><span style='color: orange;'> Bloccato il ".$this->extractioned->extracted_at."</span></strong>";
            } else {
                // different user
                $this->attributes['unlockButton'] = 'hidden';
                $this->attributes['deleteButton'] = 'hidden';
                return "<strong><span style='color: red;'> Bloccato da ".$this->extractioned->extracted_by()->first()->name." il ".$this->extractioned->extracted_at."</span></strong>";
            }
        }else{
            //attachment not extracted
            $this->attributes['unlockButton'] = 'hidden';
            return '';
        }
    }

    public function getShowTitleLink() {
        // Replace proofAttach with the name of your field
        if (isset($this->title)) {
            // dd($this);
            // downloads/{attachment_id}/{fisical_name}/{original_name}
            return '<a href="'.url(config('backpack.base.route_prefix', 'admin') . '/downloads/'.$this->id).'" >'.$this->title.'</a>';
            // return '<a href="'.url($this->id).'" target="_blank">Download</a>';
        }
    }
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

    public function extractioned()
    {
        return $this->belongsTo('App\Models\Extraction', 'extraction_id', 'id');
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
    // public function getExtractionIdAttribute()
    // {
    //     // dd($this->extraction->extracted_by);
    //     $this->attributes['deleteButton'] = '';
    //     $this->attributes['unlockButton'] = '';
    //     $this->attributes['lockButton'] = '';
    //
    //     // dd($this->extractioned);
    //     if ( isset($this->attributes['extraction_id'])) {
    //         //attachment extracted
    //         $this->attributes['lockButton'] = 'hidden';
    //         dd( $this->extractioned->extracted_by );
    //         if ( $this->extractioned->extracted_by == Auth::user()->id ) {
    //             // same user
    //             $this->attributes['unlockButton'] = '';
    //             $this->attributes['deleteButton'] = '';
    //             return "<strong><span style='color: orange;'> Bloccato il ".$this->extractioned->extracted_at."</span></strong>";
    //         } else {
    //             // different user
    //             $this->attributes['unlockButton'] = 'hidden';
    //             $this->attributes['deleteButton'] = 'hidden';
    //             return "<strong><span style='color: red;'> Bloccato da ".$this->extractioned->extracted_by()->first()->name." il ".$this->extractioned->extracted_at."</span></strong>";
    //         }
    //     }else{
    //         //attachment not extracted
    //         $this->attributes['unlockButton'] = 'hidden';
    //         return '';
    //     }
    // }

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
