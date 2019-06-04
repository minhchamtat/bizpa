<?php

namespace App\Http\Controllers\Auth;

use App\User;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = '/home';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\User
     */
    protected function create(array $data)
    {
        $iterations = 10;
        $salt = bin2hex(random_bytes(8));
        // dd($data);
        return User::create([
            //du lieu fix
            'user_type_id' => 1,
            'zip_code' => 123,
            'prefecture_id' => 1,
            'user_status_id' => 1,
            'city' => 1,
            'address_1' => 1,
            'last_name' => 1,
            'first_name' => 1,
            //-----
            // 'company_name' => $data['company_name'],
            'email' => $data['email'],
            'password' => hash_pbkdf2("sha256", $data['password'], $salt, $iterations, 20),
            'password_salt' => $salt,
            'phone' => '1291427819',
            // 'url' => $data['url'],
            // 'city' => $data['city'],
            // 'address_1' => $data['address_1'],
            // 'address_2' => $data['address_2'],
            // 'last_name' => $data['last_name'],
            // 'first_name' => $data['first_name'],
            // 'business_type' => $data['business_type'],
            // 'business_content' => $data['business_content'],
            // 'establish_year' => $data['establish_year'],
            // 'annual_sales' => $data['annual_sales'],
            // 'bank_name' => $data['bank_name'],
            // 'bank_branch' => $data['bank_branch'],
            // 'bank_number' => $data['bank_number'],
            // 'bank_holder' => $data['bank_holder'],
        ]);
    }
}
