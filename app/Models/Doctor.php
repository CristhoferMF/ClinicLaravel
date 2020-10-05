<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Doctor extends Model
{
    //
    protected $fillable = ['first_name','last_name','document_type_id','gender','document_number','status'];

    public function documentType()
    {
        return $this->belongsTo('App\Models\DocumentType')->withDefault();
    }
}
