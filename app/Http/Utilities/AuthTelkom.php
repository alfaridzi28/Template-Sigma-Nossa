<?php

namespace App\Http\Utilities;
use Illuminate\Http\Request;
use GuzzleHttp\Client;

class AuthTelkom 
{
  protected $tgpass_url,
            $tgpass_index,
            $tgpass_name,
            $tgpass_token,
            $ldap_url,
            $hr_url;

  public function __construct()
  {
      $this->tgpass_url = 'https://auth.telkom.co.id/authenticator/';
      $this->ldap_url = 'https://auth.telkom.co.id/v2/account/validate';
      $this->hr_url = 'https://auth.telkom.co.id/api/call/';
      //$this->tgpass_index = getenv('TGPASS_INDEX');
      //$this->tgpass_name = getenv('TGPASS_APPS_NAME');
      //$this->tgpass_token =getenv('TGPASS_TOKEN');
      
      $this->tgpass_index = env('TGPASS_INDEX','197');
      $this->tgpass_name = env('TGPASS_APPS_NAME','nossasqm');
      $this->tgpass_token =env('TGPASS_TOKEN','CB5EAE2903F1741F30805522C07F566DDC82FB0E0345BB368F37C0A8133455AF');

  }
  public function check()
  {
    $res = $this->callApi('check');
    return $res;
  }
  public function request(Request $request)
  {
    $pass = $request->pass;
		return $this->callApi('request','',$pass);
  }
  public function activation($request)
  {
    $token = $request->token;
    return $this->callApi('activation',$token,$request->pass);
  }
  public function validate($request)
  {
    $token = $request->token;
    // dd($request->session()->get('pass'));
	  return $this->callApi('validate',$token,$request->session()->get('pass'));
	}
  public function revoke($request)
  {
    $pass = $request->pass;
		$res = $this->callApi('revoke','',$pass);
		return $res;
  }
  public function revokeByAdmin($username)
  {
    $url = $this->tgpass_url.'revoke';
    $params = [
      'username' => $username,
      'ldap' => '99'
    ];
    $client = new Client();
    $response = $client->request('POST',$url,[
      'headers' => [
        "Index" => $this->tgpass_index,
        "AppsName" => $this->tgpass_name,
        "AppsToken" => $this->tgpass_token,
      ],
      'verify' => false,
      'form_params' => $params
    ]);

    $contents = $response->getBody()->getContents();
    return json_decode($contents, true);
  }
  public function callApi($url,$token = '',$pass = '')
  {
    $url = $this->tgpass_url.$url;
    $username = auth()->user()->username;
    $params = [
      'username' => $username,
      'ldap' => '99'
    ];
    if ($token != '') {
      $params['token'] = $token;
    }
    $client = new Client();
    $response = $client->request('POST',$url,[
      'headers' => [
        "Index" => $this->tgpass_index,
        "AppsName" => $this->tgpass_name,
        "AppsToken" => $this->tgpass_token,
      ],
      'verify' => false,
      'form_params' => $params
    ]);
    
    $contents = $response->getBody()->getContents();
    return json_decode($contents, true);
  }
  public function loginLdap(Request $request)
  {
    $client = new Client();
    $url = $this->ldap_url;
    
    if ($request->username == null) {
      $username = $request->login;
    }else{
      $username = $request->username;
    }
    
    $password = $request->password;
    
    $response = $client->request('POST',$url,[
      'headers' => [
        "Index" => $this->tgpass_index,
        "AppsName" => $this->tgpass_name,
        "AppsToken" => $this->tgpass_token,
      ],
      'verify' => false,
      'json' => [
        'username' => $username,
        'password' => $password
      ]
    ]);

    $contents = $response->getBody()->getContents();
    return json_decode($contents, true);
  }
  public function loginLdap_20220912(Request $request)
  {
    $url = $this->ldap_url;
    $username='';
    $password='';
    
    if ($request->username == null) {
      $username = $request->login;
      $password = $request->password;
    }else{
      $username = $request->username;
      $password = $request->password;
    }
    
    
    $curl = curl_init();
    
    curl_setopt_array($curl, array(
      CURLOPT_URL => $url,
      CURLOPT_RETURNTRANSFER => true,
      CURLOPT_ENCODING => '',
      CURLOPT_MAXREDIRS => 10,
      CURLOPT_TIMEOUT => 0,
      CURLOPT_FOLLOWLOCATION => true,
      CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
      CURLOPT_CUSTOMREQUEST => 'POST',
      CURLOPT_POSTFIELDS =>'{
	"username":"'.$username.'",
	"password":"'.$password.'"
    }',
      CURLOPT_HTTPHEADER => array(
	'AppsName: '.$this->tgpass_name,
	'AppsToken: '.$this->tgpass_token,
	'Content-Type: application/json',
      ),
    ));
    
    $response = curl_exec($curl);
    
    curl_close($curl);
    return json_decode($response, true);
  }
  
  public function getDataHr($username)
  {
    $client = new Client();
    $response = $client->request('GET',$this->hr_url.$username,[
      'verify' => false,
    ]);

    $contents = $response->getBody()->getContents();
    return json_decode($contents, true);

  }
}
