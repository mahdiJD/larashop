<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Client\Request;
use Illuminate\Support\Facades\Http;
use Symfony\Component\HttpFoundation\IpUtils;

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
    protected $redirectTo = '/home';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
        $this->middleware('auth')->only('logout');
    }

    protected function captcha(Request $request)
    {
     $recaptcha = $request->input('g-recaptcha-response');
    
     if (is_null($recaptcha)) {
        $request->session()->flash('message', "  Please complete the recaptcha again to proceed. ");
      return redirect()->back();
     }
    
     $url = "https://www.google.com/recaptcha/api/siteverify";
    
     $params = [
      'secret' => config('services.recaptcha.secret'),
      'response' => $recaptcha,
      'remoteip' => IpUtils::anonymize($request->ip())
     ];
      $resp->post($url, $params);
    
     $result = json_decode($response);
    
     if ($response->successful() && $result->success == true) {
      $request->session()->flash('message', " Form Submitted Successfully. ");
      return redirect()->back();
      
     } else {
      $request->session()->flash('message', "  Please complete the recaptcha again to proceed. ");
      return redirect()->back();
     }
    }
}
