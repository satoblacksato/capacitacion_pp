<?php

namespace App\Models;

use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Traits\AuditModel;

class Book extends Model
{
    use HasFactory;
    use AuditModel;
    use Sluggable;

    protected $fillable=['name','description'];

    public function category(){
        return $this->belongsTo(Category::class,'category_id','id');
    }


    public function photos(){
        return $this->hasMany(Photo::class,'book_id','id');
    }


    public function sluggable()
    {
        return [
            'slug' => [
                'source' => 'name'
            ]
        ];
    }

    public function getRouteKeyName()
    {
        return 'slug';
    }
}
