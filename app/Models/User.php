<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Passport\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    public $directoryImage =  "avatars/";

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'surname',
        'email',
        'password',
        'avatar',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token'
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'verified_at' => 'datetime',
    ];


    /**
     * 1 user belong to 1 role
     */
    public function role()
    {
        return $this->belongsTo(Role::class, 'role_id');
    }

    /**
     * Accessor to show avatar image
     */
    public function getAvatarAttribute($value)
    {
        return $this->directoryImage . $value;
    }

    function to()
    {
        return $this->hasMany(EvalNotification::class, 'to');
    }

    function from()
    {
        return $this->hasMany(EvalNotification::class, 'from');
    }

    function promotion()
    {
        return $this->belongsTo(EvalPromotion::class, 'promotion_id');
    }

    function userAnswer()
    {
        return $this->hasMany(EvalUsersAnswerLines::class, 'user_id');
    }

    /**
     * Check if it's an administrator
     */
    public function isAdmin()
    {
        if ($this->role->label == "admin") {
            return true;
        }
        return false;
    }

    public function sendPasswordResetNotification($token)
    {
        $this->notify(new \App\Notifications\MailResetPasswordNotification($token));
    }
}
