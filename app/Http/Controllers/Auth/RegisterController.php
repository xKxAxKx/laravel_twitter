<?php

namespace App\Http\Controllers\Auth;

use App\User;
use Validator;
use Image;
use App\Http\Controllers\Controller;
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
     * Where to redirect users after login / registration.
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
    protected function validator(array $data){
        return Validator::make($data, [
            'name' => 'required|max:255',
            'email' => 'required|email|max:255|unique:users',
            'image' => 'image',
            'profile' => 'max:255',
            'password' => 'required|min:6|confirmed',
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return User
     */
    protected function create(array $data){

        $user =  User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => bcrypt($data['password']),
        ]);

        if(isset($data['image'])){
            // getClientOriginalName()：アップロードしたファイルのオリジナル名を取得する
            $fileName = $data['image']->getClientOriginalName();
            // getRealPath()：アップロードしたファイルのパスを取得する
            $image = Image::make($data['image']->getRealPath());
            // 画像を保存するpathを指定する
            $path = sprintf('images/%d/%s', $user->id, $fileName);
            $dir = dirname(public_path($path));
            mkdir($dir, 0777, true);
            $image->save(public_path($path), $fileName);
            $user->image = $path;
        }

        if(isset($data['profile'])){
          $user->profile = $data['profile'];
        }

        $user->save();
        return $user;
    }
}
