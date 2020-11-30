<?php

namespace App\Models;

use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Fortify\TwoFactorAuthenticatable;
use Laravel\Jetstream\HasProfilePhoto;
use Laravel\Jetstream\HasTeams;
use Laravel\Sanctum\HasApiTokens;
use App\Traits\DataString as InlineObject;
use Silber\Bouncer\Database\HasRolesAndAbilities;

class User extends Authenticatable
{
    use HasApiTokens;
    use HasFactory;
    use HasProfilePhoto;
    use HasTeams;
    use Notifiable;
    use TwoFactorAuthenticatable;
    use InlineObject;
    use Sluggable;
    use HasRolesAndAbilities;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
        'two_factor_recovery_codes',
        'two_factor_secret',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',

    ];


    /**
     * The accessors to append to the model's array form.
     *
     * @var array
     */
    protected $appends = [
        'profile_photo_url',
    ];


    public function getNameAttribute($value){
        return \Str::upper($value);
    }

    public function setNameAttribute($value){
        $this->attributes['name']=\Str::lower($value);
    }


   public function booksCreated(){
       return $this->hasMany(Book::class,'created_user','id');
   }
   public function booksUpdated(){
    return $this->hasMany(Book::class,'updated_user','id');
   }

    public function categoriesCreated(){
    return $this->hasMany(Category::class,'created_user','id');
    }
    public function categoriesUpdated(){
    return $this->hasMany(Category::class,'updated_user','id');
    }

    public function photosCreated(){
        return $this->hasMany(Photo::class,'created_user','id');
    }
    public function photosUpdated(){
    return $this->hasMany(Photo::class,'updated_user','id');
    }


    public function sluggable()
    {
        return [
            'slug' => [
                'source' => 'name'
            ]
        ];
    }

}


