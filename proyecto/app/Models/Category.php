<?php

namespace App\Models;

use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\{Model,SoftDeletes};
use App\Traits\{AuditModel,HasPhoto};

class Category extends Model
{
    use HasFactory;
    use AuditModel;
    use HasPhoto;
    use SoftDeletes;
    use Sluggable;

    protected $table='categories'; //nombre de la tabla a la que se conectan

    protected $fillable=['name','description','photo'];

    public function books(){
        return $this->hasMany(Book::class,'category_id','id');
    }

    public function myBooks(){
        return $this->books()->where('created_user',optional(auth()->user())->id);
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
