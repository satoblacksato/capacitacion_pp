<?php
namespace App\Traits;
use App\Models\User;

trait AuditModel{

    public function userCreated(){
        return $this->belongsTo(User::class,'created_user','id');
    }

    public function userUpdated(){
        return $this->belongsTo(User::class,'updated_user','id');
    }

    protected static function booted()
    {
        static::creating(function ($obj) {
            $obj->created_user=optional(auth()->user())->id??1;
            $obj->updated_user=optional(auth()->user())->id??1;
            $obj->created_ip=request()->ip();
            $obj->updated_ip=request()->ip();
        });
    }
}
