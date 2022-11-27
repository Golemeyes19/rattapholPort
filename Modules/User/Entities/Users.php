<?php

namespace Modules\User\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Contracts\Auth\CanResetPassword ;

use Illuminate\Support\Facades\Notification;
use Illuminate\Notifications\Notifiable;
use Modules\User\Notifications\NotiUserResetPassword ;

use Laravel\Passport\HasApiTokens;
use Modules\User\Emails\UserEmail;



// class Users extends Authenticatable
class Users extends Authenticatable
{
    use HasFactory;
    use \Illuminate\Notifications\Notifiable;
    use HasApiTokens ;

    protected $fillable = ['id','group_id','name','username','email','password','avatar','role','locale','status','api'];
    protected $table = "users";
    protected $primaryKey = "id";

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
    ];
    
    protected static function newFactory()
    {
        return \Modules\User\Database\factories\UsersFactory::new();
    }

    public function group()
    {
        return $this->hasOne('Modules\User\Entities\Groups','id','group_id');
    }

    public function sendPasswordResetNotification($token) { 
        // echo $token ;
        $noti = $this->notify(new NotiUserResetPassword($token));
    }

}
