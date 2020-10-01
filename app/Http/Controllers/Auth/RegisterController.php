<?php

namespace App\Http\Controllers\Auth;

use App\User;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;
use App\Models\DocumentType;

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

    public function showRegistrationForm()
    {
        $documentTypes = DocumentType::all();
        return view('auth.register',['documentTypes'=>$documentTypes]);
    }

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
            'document_type'  => ['required','exists:document_types,id'],
            'document_number'  => ['required','string','max:14'],
            'father_last_name'  => ['required','string','max:255'],
            'mother_last_name'  => ['required','string','max:255'],
            'first_name'  => ['required','string','max:255'],
            'born_date'  => ['required','date_format:d/m/Y'],
            'phone'  => ['required','numeric','digits:9'],
            'gender' => ['required', 'in:M,F'],
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
   
        $data['document_type_id'] = $data['document_type'];
        $data['last_name'] = $data['father_last_name'].' '.$data['mother_last_name'];
        $data['password'] = Hash::make($data['password']);
        $data['born_date'] = date('Y-m-d', strtotime(str_replace('-', '/', $data['born_date'])));
       
        return User::create($data);
    }
}
