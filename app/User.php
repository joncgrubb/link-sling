<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

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
        'password', 'remember_token',
    ];

    public function sent() {
        return $this
                ->hasMany('App\Message', 'sender_id')
                ->where('sent_at', '!=', null)
                ->where('is_deleted', '=', false);
    }

    public function contacts() {
        return $this
                ->hasMany('App\Contact', 'owner');
    }
}
