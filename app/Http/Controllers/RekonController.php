<?php

namespace App\Http\Controllers;

use App\Helper\FS;
use Illuminate\Support\Facades\Http;
class RekonController extends Controller
{

    public function manageRekon(){
        return !\Str::contains(auth()->user()->module, ['all', 'rekon-csv']) ? redirect()->back() : view('rekon-csv.create');
    }

    public function postRekon(){
        if(\Str::contains(auth()->user()->module, ['all', 'rekon-csv'])){

            $data       = request()->all();
            $attachment = request()->attachment;

            unset($data['_method'], $data['_token']);

            if(request()->hasFile('ATTACHMENT')){
                $attachment         = "http://10.6.3.135:8000/attachment/" . FS::save("attachment", request()->file('ATTACHMENT'));
                // $attachment         = "localhost:8000/attachment/" . FS::save("attachment", request()->file('ATTACHMENT'));
                $data['URL'] = $attachment;
            }

            unset($data['ATTACHMENT']);

            $client = new \GuzzleHttp\Client();
            $result    = $client->post('http://10.60.163.39/service/index.php/json/insertURL', ['body' => json_encode($data)]);
            // $result = $client->post('localhost:3000/test-rekon', ['form_params' => $data]);

            if($result->getStatusCode() == 200){
                return redirect()->back()->with('message', 'Operation success');
            }

        } else {
            return response()->json('You dont have permission to access this page', 500);
        }

    }

    public function viewRekon(){
        return !\Str::contains(auth()->user()->module, ['all', 'rekon-csv']) ? redirect()->back() : view('rekon-csv.index');
    }

    public function viewRekonBulk(){
        return !\Str::contains(auth()->user()->module, ['all', 'rekon-csv']) ? redirect()->back() : view('rekon-csv.create-bulk');
    }

    public function iframe(){
        return view('rekon-csv.iframe');
    }
}
