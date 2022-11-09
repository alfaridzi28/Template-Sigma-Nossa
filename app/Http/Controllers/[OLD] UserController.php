<?php

namespace App\Http\Controllers;

use App\Module;
use App\User;
use App\Submodule;
use GuzzleHttp\Client;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller {

    public function index() {
         $modules       = Module::with('submodules')->get();
         $submodules    = Submodule::get();
         $users         = User::orderBy('username')->get();

        return view('user.index', compact('modules', 'users', 'submodules'));
    }

    public function landing() {
        $modules       = Module::with('submodules')->get();

        return view('user.landing', compact('modules'));
    }


    public function create() {
        return view('user.create', [
            'modules'   => Module::orderBy('module')->get()
        ]);
    }

    public function store(Request $request) {
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

        if($user->save()){
            return redirect()->back()->with('message', 'User successfully created');
        } else {
            return redirect()->back()->with('error', 'Cannot update user at the moment');
        }
    }


    public function showMenu(Submodule $submodule) {

        $modules = Module::with('submodules')->get();
        return view('user.menu', compact('submodule', 'modules'));
    }

    public function update(Request $request) {

        $user = User::findOrFail($request->id);

        $user->description      = request('description');
        $user->password         = sha1(request('password'));
        $user->role             = request('role');
        $user->active           = request('active');
        $user->active_reason    = request('active_reason');
        $user->module           = implode(',', request('module'));

        if($user->save()){
            return redirect()->back()->with('message', 'User successfully updated');
        } else {
            return redirect()->back()->with('error', 'Cannot update user at the moment');
        }
    }


    public function auth(Request $request){
        // $user = User::where(['username' => request('username'), 'password' => sha1(request('password'))])->first();

        if(request('agree') == true){
            $request->validate([
                /* 'captcha' => 'required|captcha' */
            ]);

            if (request('loginAuth') == 'ldap'){
                
                /* $user = User::select('username')->where('username',request('username'))->exist();

                if (request('ldap') != true) {
                    dd(User::select('username')->where('username',request('username'))->exist());
                    return redirect()->back()->with('message', 'You are not a LDAP user');
                } else {
                    dd('MASUK');
                } */

                $client = new Client();
                $res = $client->request('POST', 'http://ldap-sqm.apps.paas.telkom.co.id', [
                    'form_params' => [
                        'nik' => request('username'),
                        'password' => request('password'),
                    ]
                ]);

                $contents = $res->getBody()->getContents();
                $jsonRes = json_decode($contents, true);
                $uid = $jsonRes['0']['uid'][0];
                $name = $jsonRes['0']['cn'][0];

                print_r($uid);
                

                if (User::select('username')->where('username',$jsonRes['0']['uid'][0])->exists()) {
                /*  print_r('ADA'); */
                    if(auth()->attempt(['username' => request('username'), 'password' => sha1(request('password'))])){
                        return redirect('/');
                    } else {
                        return redirect()->back()->with('message', 'Wrong username or password');
                    }
                } else {
                    /* print_r('GA ADA, ayo bikin akun dengan username = '. $uid); */
                    User::create([
                        'username' => request('username'),
                        'password' => sha1(request('password')),
                        'ldap' => true,
                        'description' => $name
                    ]);

                    if(auth()->attempt(['username' => request('username'), 'password' => sha1(request('password'))])){
                        return redirect('/');
                    } else {
                        return redirect()->back()->with('message', 'Wrong username or password');
                    }
                }

            //    return redirect()->back()->with('message', $jsonRes);

            } else {
                /* if (request('ldap') !== true) {
                    return redirect()->back()->with('message', 'You are not a LDAP user');
                } else {
                    
                } */
                if(auth()->attempt(['username' => request('username'), 'password' => sha1(request('password')), 'active' => '1',])){

                    // $user = ['superadmin', 'bukanscmttools'];

                    // Auth::login($user);

                    return redirect('/');
                } else {
                    return redirect()->back()->with('message', 'Wrong username or password');
                }
            }
        } else {
            return redirect()->back()->with('message', 'Please check Ketentuan Penggunaan');
        }
    }

    public function login(){
        return view('user.login');
    }

    public function logout(){
        auth()->logout();
        return redirect('/');
    }
}
