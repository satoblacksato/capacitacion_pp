<?php

namespace App\Traits;

use Illuminate\Http\UploadedFile;

trait HasPhoto{

    public function setPhotoAttribute($value){
        if($value instanceof UploadedFile){
            $this->attributes['photo']=$value->storeAs($this->table,uniqid().'.'.$value->getClientOriginalExtension());
        }
    }
}
