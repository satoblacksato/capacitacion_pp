<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Traits\AuditModel;
use Illuminate\Http\UploadedFile;

class Photo extends Model
{
    use HasFactory;
    use AuditModel;

    protected $fillable=['name'];

    public function book(){
        return $this->belongsTo(Book::class,'book_id','id');
    }

    public function setNameAttribute($value){
        if($value instanceof UploadedFile){
            $this->attributes['name']=$value->storeAs('photos',uniqid().'.'.$value->getClientOriginalExtension());
        }
    }
}
