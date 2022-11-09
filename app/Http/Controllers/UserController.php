<?php

namespace App\Http\Controllers;

use App\Http\Utilities\AuthTelkom;
use App\Module;
use App\User;
use App\Submodule;
use GuzzleHttp\Client;
use Illuminate\Contracts\Session\Session;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Response;
use Illuminate\Support\Str;

class UserController extends Controller
{

    public function index()
    {
        $modules       = Module::with('submodules')->get();
        $submodules    = Submodule::get();
        $users         = User::orderBy('username')->get();

        return view('user.index', compact('modules', 'users', 'submodules'));
    }

    public function landing()
    {
        $modules       = Module::with('submodules')->get();

        return view('user.landing', compact('modules'));
    }


    public function create()
    {
        return view('user.create', [
            'modules'   => Module::orderBy('module')->get()
        ]);
    }

    public function store(Request $request)
    {
        request()->validate([
            'username'  => ['unique:users,username'],
            'password'  => ['required'],
            'role'      => ['required', 'in:superadmin,admin,user'],
        ]);

        $user                   = new User;
        $user->username         = request('username');
        $user->password         = sha1(request('password'));
        $user->description      = request('description');
        $user->role             = request('role');
        $user->active           = request('active');
        $user->active_reason    = request('active_reason');
        $user->module           = $user->role == 'superadmin' ? 'all' : implode(',', request('module'));

        if ($user->save()) {
            return redirect()->back()->with('message', 'User successfully created');
        } else {
            return redirect()->back()->with('error', 'Cannot update user at the moment');
        }
    }


    public function showMenu(Submodule $submodule)
    {

        $modules = Module::with('submodules')->get();
        return view('user.menu', compact('submodule', 'modules'));
    }

    public function update(Request $request)
    {

        $user = User::findOrFail($request->id);

        $user->description      = request('description');
        if ($user->ldap == null) {
            $user->password     = sha1(request('password'));
        }else{
            $user->password     = '';
        }
        $user->role             = request('role');
        $user->active           = request('active');
        $user->active_reason    = request('active_reason');
        $user->module           = implode(',', request('module'));

        if ($user->save()) {
            return redirect()->back()->with('message', 'User successfully updated');
        } else {
            return redirect()->back()->with('error', 'Cannot update user at the moment');
        }
    }

    public function tele2fa(Request $request)
    {
        $user = User::where('username', request('username'))->first();
        /* dd($user); */
        $user->telegram_id = request('telegram_id');
        $user->save();
        return redirect('/login');
    }

    public function auth2fa(Request $request)
    {
        $user = User::where('username', $request->username)->first();

        /* Kalau metodenya LDAP */
        if (request('loginAuth') == 'ldap') {

            $auth = new AuthTelkom;
            $res = $auth->loginLdap($request);
            //print_r(request());
            //print_r($res);exit;
            if ($res['status'] && $res['status'] == 'fail' ) {
              return redirect()->back()->with('message', $res['note']);
            }

            if (!$user) {
              $hr = $auth->getDataHr($request->username);
              $name = $hr['name'];
              $user = User::create([
                'username' => request('username'),
                'ldap' => true,
                'role' => 'Default LDAP',
                'module' => 'sqm-predictive-logic,sqm-predictive-physic,rca-internet-lambat,sqm-predictive-metro-down,sqm-metro-down-link-kritis,sqm-metro-down-ne-to-ne,sqm-metro-down-traffic-forecasting,sqm-metro-down-tsel-analisis,sqm-metro-down-tsel-view,quality-port-metro-down',
                'description' => $name,
                'is_ldap_and_signed_in' => true,
              ]);
            }
        }

        if (!$user) {
            return redirect('/login')->with('message', 'Wrong Username or Password!');
        }
        
        if ($user->telegram_id == null) {
          $username = request('username');
          $password = request('password');
          /* dd($user->telegram_id); */
          return view('user.2fa', compact('username', 'password'));
        } else {
            $username = request('username');
            $password = request('password');
            $loginAuth = request('loginAuth');
            // request ke ms otp tele dengan parameter telegram_id
            $clientotp = new Client();
            $resotp = $clientotp->request('POST', 'http://api-telegram-sqm.apps.paas.telkom.co.id/public/index.php', [
                'form_params' => [
                    'telegram_id' => $user->telegram_id,
                ]
            ]);
            $otp = json_decode($resotp->getBody()->getContents(), true);
            session(['kode_otp' => $otp]);
            return view('user.otp', compact('username', 'password', 'loginAuth'));
        }
    }


    public function auth(Request $request)
    {
        $get_otp_from_session = session()->get('kode_otp')['kode_otp'];
        $otp = request('otp');

        //if ($otp === $get_otp_from_session) {
        //    /* dd('OTP BENAR, SILAKEN MASUK', $get_otp_from_session, $otp); */
        //} 
        if ($otp === $get_otp_from_session) {
          if (request('agree') == true) {
            /* $request->validate([
                'captcha' => 'required|captcha'
            ]); */
            $user = User::where('username', $request->username)->first();
            $lolos = false;
            if (request('loginAuth') == 'ldap') {
                
                $auth = new AuthTelkom;
                $res = $auth->loginLdap($request);
                if ($res['status'] && $res['status'] == 'fail' ) {
    
                  return redirect()->back()->with('message', $res['note']);
                }
    
                if (!$user) {
                  $hr = $auth->getDataHr($request->username);
                  $name = $hr['name'];
                  $user = User::create([
                    'username' => request('username'),
                    'ldap' => true,
                    'role' => 'Default LDAP',
                    'module' => 'sqm-predictive-logic,sqm-predictive-physic,rca-internet-lambat,sqm-predictive-metro-down,sqm-metro-down-link-kritis,sqm-metro-down-ne-to-ne,sqm-metro-down-traffic-forecasting,sqm-metro-down-tsel-analisis,sqm-metro-down-tsel-view,quality-port-metro-down',
                    'description' => $name,
                    'is_ldap_and_signed_in' => true,
                  ]);
                }
                $lolos= true;
            }else{
              if (sha1($request->password) === $user->password) {
                $lolos = true;
              }
            }
            if ($lolos) {
                Auth::login($user);
                return redirect('/landing');
            } else {
                return redirect('/login')->with('message', 'Wrong username or password (local user)');
            }
          } else {
              return redirect()->back()->with('message', 'Please check Ketentuan Penggunaan');
          }
        } else {
            return redirect('/login')->with('message', 'Kode OTP anda SALAH');
        }
        
    }

    public function authafterotp(Request $request)
    {
        $sessionOtp = session()->get('kode_otp');
        $get_otp_from_session = '';
        if (array_key_exists('kode_otp',$sessionOtp)) {
          $get_otp_from_session = $sessionOtp['kode_otp'];
        }
        $otp = request('otp');
        if ($otp === $get_otp_from_session) {
          if (request('agree') == true) {
            /* $request->validate([
                'captcha' => 'required|captcha'
            ]); */
            $user = User::where('username', $request->username)->first();
            $lolos = false;
            if (request('loginAuth') == 'ldap') {
                
                $auth = new AuthTelkom;
                $res = $auth->loginLdap($request);
                if ($res['status'] && $res['status'] == 'fail' ) {
    
                  return redirect()->back()->with('message', $res['note']);
                }
    
                if (!$user) {
                  $hr = $auth->getDataHr($request->username);
                  $name = $hr['name'];
                  $user = User::create([
                    'username' => request('username'),
                    'ldap' => true,
                    'role' => 'Default LDAP',
                    'module' => 'sqm-predictive-logic,sqm-predictive-physic,rca-internet-lambat,sqm-predictive-metro-down,sqm-metro-down-link-kritis,sqm-metro-down-ne-to-ne,sqm-metro-down-traffic-forecasting,sqm-metro-down-tsel-analisis,sqm-metro-down-tsel-view,quality-port-metro-down',
                    'description' => $name,
                    'is_ldap_and_signed_in' => true,
                  ]);
                }
                $lolos= true;
            }else{
              if (sha1($request->password) === $user->password) {
                $lolos = true;
              }
            }
            if ($lolos) {
                $token = hash('md5',Str::random(20));
                Auth::login($user);
                DB::table('sessionuser')->insert([
                  'sessionid' => 'nossa_sqm',
                  'sessionvalue' => $token,
                  'sessionexpiredtime' => now()->addHour(),
                  'sessiondate' => now()
                ]);
                Cookie::queue('nossa_sqm', $token, 60, null, '.telkom.co.id');
                return redirect('/landing');
            } else {
                return redirect('/login')->with('message', 'Wrong username or password (local user)');
            }
          } else {
              return redirect()->back()->with('message', 'Please check Ketentuan Penggunaan');
          }
        } else {
            return redirect('/login')->with('message', 'Kode OTP anda SALAH');
        }
    }

    public function login()
    {
        return view('user.login');
    }

    public function logout()
    {
        Cookie::queue('nossa_sqm', null, 0, null, '.telkom.co.id');
        auth()->logout();
        return redirect('/login');
    }
    public function setCookie(Request $request) {
        $minutes = 1;
        $response = new Response('Hello World');
        $response->withCookie(cookie('nossa_manual', 'testing', $minutes));
        return $response;
    }
    public function getCookie(Request $request) {
        $value = $request->cookie('nossa_manual');
        echo $value;
    }
}
