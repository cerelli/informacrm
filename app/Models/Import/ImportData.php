<?php

namespace App\Models\Import;

use Illuminate\Database\Eloquent\Model;

class ImportData extends Model
{
    protected $table = 'import_data';

    protected $fillable = ['filename', 'header', 'data'];
}
