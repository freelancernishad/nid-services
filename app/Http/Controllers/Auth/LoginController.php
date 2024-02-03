<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    // protected $redirectTo = RouteServiceProvider::HOME;



    protected $redirectTo = '/dashboard';
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    public function login(Request $request)
    {
        // $input = $request->all();

        // $this->validate($request, [
        //     'email' => 'required|email',
        //     'password' => 'required',
        // ]);

        // if(auth::attempt(array('email' => $input['email'], 'password' => $input['password'])))
        // {
        //     // return auth::user();

        //     if (auth()->user()) {
        //         return redirect('dashboard');
        //     }




        // }else{
        //     return redirect()->route('login')
        //         ->with('error','Email-Address And Password Are Wrong.');
        // }




        // $validator = Validator::make($request->all(), [
        //     'email' => 'required|email',
        //     'password' => 'required',
        // ]);
        // if ($validator->fails()) {
        //     return sent_error('validation error', $validator->errors(), 422);
        // }

        $credentials = $request->only('email', 'password');
        if (Auth::attempt($credentials)) {
             $user = Auth::user();

            // $data['id'] = $user->id;
            // $data['school_id'] = $user->school_id;
            // $data['name'] = $user->name;
            // $data['email '] = $user->email;
            $user['access_token'] = $user->createToken('accessToken')->accessToken;

            //  return sent_response('Login Success', $data);
            return $this->respondWithToken($user['access_token']);
        } else {
            return 0;
        }




    }


    protected function respondWithToken($token)
    {




     $users = auth()->user();
$users['token_type'] ='bearer';
$users['expires_in'] =60;

return response()->json($users);
        return response()->json([
            'access_token' => $token,
            'token_type' => 'bearer',
            'expires_in' => 60,

            'user_id' => auth()->user()->id,
            'name' => auth()->user()->name,
            'email' => auth()->user()->email,
            'role' => auth()->user()->role,
            'class' => auth()->user()->class,
            'teacherOrstudent' => auth()->user()->teacherOrstudent,
            'users' => auth()->user(),
        ]);
    }

}
