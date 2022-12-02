<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use App\Models\User;
use App\Models\Zip;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Symfony\Contracts\Service\Attribute\Required;

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
    protected $redirectTo = RouteServiceProvider::HOME;

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
        $validator = Validator::make($data, [
            // 'name' => ['required', 'string', 'max:255'],
            'register_email' => ['required', 'string', 'email', 'max:255', 'unique:users,email'],
            'register_password' => ['required', 'string', 'min:8'],
            'register_zip' => ['required', 'integer'],
            'terms' =>['required'],

        ],
    [
        'terms.required'    => 'Please Accept Terms and Conditions',
    ]);

        $validator->setAttributeNames([
            'register_email' => 'email',
            'register_zip' => 'zip',
            'register_password' => 'password',
        ]);

        return $validator;
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\Models\User
     */
    protected function create(array $data)
    {
        $zip = Zip::where('name', $data['register_zip'])->first();
        if (is_null($zip)) {
            session()
                ->flash(
                    'warning',
                    'Thanks for registration but your area is not in our range when we start working in your area we must inform you'
                );
        } else {
            session()
                ->flash('success', 'Thanks for registration you can take our plan');
        }
        $user = User::create([
            // 'name' => $data['name'],
            'email' => $data['register_email'],
            'password' => Hash::make($data['register_password']),
            'zip' => $data['register_zip'],
        ]);
        // $user->createOrGetStripeCustomer();
        // session()->put('dashboard','user-dash-form');
        return $user;
    }
}
