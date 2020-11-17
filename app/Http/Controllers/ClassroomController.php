<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Google_Client;
use Google_Service_Classroom;

class ClassroomController extends Controller
{
    public function __construct()
    {
        session_start();
        
        $client = new Google_Client();
        // $google_client_token = [
        //     'access_token' => $_SESSION['access_token'],
            // 'refresh_token' => $_SESSION['refresh_token'],
            // 'expires_in' => $_SESSION['expires_in'],
        // ];
        $client->setAuthConfig('credentials.json');
        $client->setRedirectUri(env('GOOGLE_REDIRECT'));
        $client->addScope(Google_Service_Classroom::CLASSROOM_COURSES,Google_Service_Classroom::CLASSROOM_COURSEWORK_STUDENTS,Google_Service_Classroom::CLASSROOM_ANNOUNCEMENTS);
        $client->setAccessToken($_SESSION['access_token']);
        $client->setDeveloperKey(env('GOOGLE_DEVELOPER_KEY'));
        $client->setApplicationName(env('GOOGLE_APPLICATION_NAME'));
        $client->setIncludeGrantedScopes(true);
        $client->setAccessType('online');

        $guzzleClient = new \GuzzleHttp\Client(array('curl' => array(CURLOPT_SSL_VERIFYPEER => false)));
        $client->setHttpClient($guzzleClient);

        $this->client = $client;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        return view('classroom.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
