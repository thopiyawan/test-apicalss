<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use GuzzleHttp\Client as HttpClient;
use Illuminate\Support\Facades\Auth;
use App\Connection;


class routeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function schools()
    {
        return view('schools');
    }
    public function parents()
    {
        return view('parents');
    }
    public function hospitals()
    {
        return view('hospitals');
    }

    public function cal_BMI(Request $request)
    {
        $weight = $request->input('weight');
        $height = $request->input('height');
        $BMI = $weight/(($height/100)*($height/100)); 
        return view('user', ['bmi' =>$BMI]);
    }
    public function ibw(Request $request)
    {

         $g = $request->input('gender');
         $h = $request->input('height');
      if($g == 'm'){
         $w = 48+1.1*($h-150);
      }else{
         $w = 45+0.9*($h-150);
      }
      $result=['gender' => $g ,
               'height' => $h ,
               'weighrt' =>$w
               
      ];
    return response()->xml($result);
    }
    public function sql_db()
    {
        $a = DB::table('hospitals')->get();
        return $a;
    }

    public function sql_db_id($id)
    {
        $a = DB::table('hospitals')->where('id',$id)->get();
        return $a;
    }
    public function sql_db_post(Request $request)
    {  
        $id = $request->input('id');
        $na = $request->input('na');
        $addr = $request->input('addr');
        $numb = $request->input('numb'); 
        $numd = $request->input('numd');

        $a = DB::insert('insert into hospitals (id, name,address,numberOfBeds,numberOfDoctors,created_at,updated_at) values (?, ?,?,?,?,?,?)', [$id, $na, $addr,$numb,$numd,NOW(),NOW()]);
        return $a;
    }
    public function api_auth(Request $request)
    {  
        $query = http_build_query([
            'client_id' => 12,
            'redirect_uri' => 'http://localhost/auth/callback',
            'response_type' => 'code',
            'scope' => ''
        ]);
        $url = 'http://kdtest-parents.ptitu.de/oauth/authorize?'.$query;
        return redirect($url);
    
    }

    public function callback(Request $request) {
        $client = new HttpClient();
        $url = 'http://kdtest-parents.ptitu.de/oauth/token';
        $response = $client->post($url, [
          'form_params' => [
             'grant_type' => 'authorization_code',
             'client_id' => '12',
             'client_secret' => 'V10tSLWobRXcf5TN6SFxcUAUgLScqIcqlROoRBUF',
             'redirect_uri' => route('callback'),
             'code' => $request->input('code'),
           ]
        ]);
        $token = json_decode((string) $response->getBody(), true);
       // dd($token);
       $userId = Auth::user()->id;
       
       // Save to the database
       $connection = new connection;
       $connection->user_id = $userId;
       $connection->access_token = $token['access_token'];
       $connection->refresh_token = $token['refresh_token'];
       $connection->expires_in = $token['expires_in'];
       $connection->save();
   
       // Redirect to profile page
       //return redirect(route('home'));
       return redirect(route('profile'));
   
     }

    public function profile(Request $req){
        // dd($req);
        $user_id = Auth::user()->id;
        $token = DB::table("connection")->where("user_id",$user_id)->first();
        $isconnected = $token != null;
        return view("home",["isconnected"=>$isconnected]);
    }
     
    


}
