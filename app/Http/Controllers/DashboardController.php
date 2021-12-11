<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

// vendor
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DashboardController extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    public function index(Request $request)
    {   
        $url ='http://maimaid.id:8002/user/read';
        $body_jumlah = json_encode([ "page"=> 0,"offset"=>0]);
        $jumlah_data = json_decode($this->RestAPI($url,$body_jumlah ))->data->total;
        // dd($jumlah_data);/
        $perpage = 10;
        if (isset($request->page)) {
            $pageno = $request->page;
        } else {
            $pageno = 1;
        }
        
        
        $page = $perpage*($pageno-1);
        // dd($request->page);


        $body = json_encode([ "page"=> $page ,"offset"=>$perpage]);
        $data = json_decode($this->RestAPI($url,$body ));
        $data_rows = $data->data->rows;
        $data_jumlah = $data->data->total;
   
        $d['data_rows'] = $data_rows;
        $d['data_jumlah'] = $jumlah_data;
        $d['page'] = floor($jumlah_data/$perpage);
        // dd($d);
  
        return view('welcome',$d);
    }

    public function create(Request $request)
    {   
      
  
        return view('create');
    }

    public function update_prosess(Request $request)
    {   
        
        $this->validate($request,[
            'fullname' => 'required|min:3|alpha',
            'email' => 'required|email',
            'gender' => 'required', 
            'dob' => 'required', 
            'agree' => 'accepted'  
        ]);
        
        $url ='http://maimaid.id:8002/user/update';
        $body = json_encode([ "id" => $request->id,"fullname"=>$request->fullname, "email"=>$request->email, "password"=>$request->password == '' ? $request->password_lama : md5($request->password), "gender"=>$request->gender, "dob"=>$request->dob]);
   
        $data = json_decode($this->RestAPI($url,$body ));
  
        if ($data->status->code == 200) {
            return redirect('/')->with(['success' => 'Update Berhasil']);
        }else{
            return redirect('edit/'.$request->id)->with(['error' => 'Create belum Berhasil']);
        }
  
        
    }
     

    public function edit($id)
    {   
        $url ='http://maimaid.id:8002/user/view';
        $body = json_encode([ "id"=> $id]);
        $data = json_decode($this->RestAPI($url,$body ));
      
        $d['data_user'] = $data->data;
  
        return view('edit',$d);
    }

    public function create_prosess(Request $request)
    {   

        $this->validate($request,[
            'fullname' => 'required|min:3|alpha',
            'email' => 'required|email',
            'password' => 'required|string|regex:/^(?=.*[A-Za-z])(?=.*\d)[A-Za-z\d]{6,}$/',
            'confirm_password' => 'required|same:password',  
            'gender' => 'required', 
            'dob' => 'required', 
            'agree' => 'accepted'  
        ]);
   
        $url ='http://maimaid.id:8002/user/create';
        $body = json_encode([ "fullname"=>$request->fullname, "email"=>$request->email, "password"=>md5($request->password), "gender"=>$request->gender, "dob"=>$request->dob]);

        $data = json_decode($this->RestAPI($url,$body ));
     
        if ($data->status->code == 200) {
            return redirect('/')->with(['success' => 'Create Berhasil']);
        }else{
            return redirect('create')->with(['error' => 'Create belum Berhasil']);
        }
  
        
    }

    public function RestAPI($url,$body)
    {
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
          CURLOPT_POSTFIELDS =>$body ,
          CURLOPT_HTTPHEADER => array(
            'Content-Type: application/json'
          ),
        ));
        
        $response = curl_exec($curl);
        
        curl_close($curl);
        return $response;
    }
}
