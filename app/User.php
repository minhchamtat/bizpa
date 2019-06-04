<?php

namespace App;

use App\Notifications\UserResetPassword;
use Illuminate\Auth\Passwords\CanResetPassword;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use CanResetPassword;
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $table = 'users';

    protected $fillable = [
        'name', 'email', 'password', 'password_salt',
        'phone', 'zip_code', 'prefecture_id', 'city',
        'address_1', 'last_name', 'first_name',
        'user_status_id', 'company_name', 'url', 'city',
        'address_2', 'business_type', 'business_content',
        'establish_year', 'annual_sales', 'bank_name', 'bank_branch',
        'bank_number', 'bank_holder',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * Sends the password reset notification.
     *
     * @param  string $token
     *
     * @return void
     */
    public function sendPasswordResetNotification($token)
    {
        $when = now()->addSeconds(30);
        $this->notify((new UserResetPassword($token, $this->email))->delay($when));
    }
}
