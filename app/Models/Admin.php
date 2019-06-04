<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class Admin extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $table = 'administrators';

    protected $fillable = [
        'name', 'password', 'password_salt',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function getRecordTitle()
    {
        return $this->attributes['name'];
    }

    public function getLogoPath()
    {
        return "/adminlte/img/avatar_" . rand(1, 5) . ".png";
    }
}
