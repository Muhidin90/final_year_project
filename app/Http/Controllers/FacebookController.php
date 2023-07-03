<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class FacebookController extends Controller
{
    public function getUserByUsername(Request $request)
    {
        $fb = new Facebook([
            'app_id' => 'Y964512057936651',
            'app_secret' => 'YOUR_APP_SECRET',
            'default_graph_version' => 'v14.0',
        ]);

        try {
            $response = $fb->get('/' . $request->input('username') . '?fields=id,name,email,location,picture', 'YOUR_ACCESS_TOKEN');
            $user = $response->getGraphNode()->asArray();
            return response()->json($user);
        } catch (\Facebook\Exceptions\FacebookResponseException $e) {
            return response()->json(['error' => 'Graph API returned an error: ' . $e->getMessage()], 500);
        } catch (\Facebook\Exceptions\FacebookSDKException $e) {
            return response()->json(['error' => 'Facebook SDK returned an error: ' . $e->getMessage()], 500);
        }
    }

}