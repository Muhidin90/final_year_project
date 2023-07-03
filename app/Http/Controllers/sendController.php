<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Http;
use Illuminate\Http\Request;

class sendController extends Controller
{
    public function send(){
        $phone = $_GET['tell'];
        $msg = $_GET['msg'];
        
        $key = 'eba6853f85205174';
        $secret = 'ZWM4ZGY2OGE0OWRiYjM0MjY2MGY1MWQwYmIyZjAwYjkzZWZhN2NiMThjNmQ4MDk2NTlmZWMzMGQ3ODVlNzAxZg==';
        
        // return ($phone.':'.$msg);
        $response = Http::withHeaders([
            'Authorization' => 'Basic ' . base64_encode($key . ':' .$secret ),
        ])->post('https://apisms.beem.africa/v1/send', [
            'source_addr' => 'INFO',
            'encoding' => 0,
            'message' => $msg,
            'recipients' => [
                [
                    'recipient_id' => '1',
                    'dest_addr' => $phone
                ]
            ]
        ]);
        
      $code = $response->status();
      return ($code);
     
    }



}
