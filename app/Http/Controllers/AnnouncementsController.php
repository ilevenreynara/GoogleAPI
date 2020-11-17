<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Announcement;
use Laravel\Socialite\Facades\Socialite;
use Carbon;
use Google_Client;
use Google_Service_Calendar;
use Google_Service_Calendar_Event;
use Google_Service_Calendar_ConferenceData;
use Google_Service_Calendar_CreateConferenceRequest;
use Google_Service_Calendar_ConferenceSolutionKey;

class AnnouncementsController extends Controller
{
    protected $client;
    protected $service;

    public function __construct()
    {
        session_start();
        
        $client = new Google_Client();
        $client->setAuthConfig('credentials.json');
        $client->setRedirectUri(env('GOOGLE_REDIRECT'));
        $client->addScope(Google_Service_Calendar::CALENDAR, Google_Service_Calendar::CALENDAR_EVENTS);
        $client->setAccessToken($_SESSION['access_token']);
        $client->setDeveloperKey(env('GOOGLE_DEVELOPER_KEY'));
        $client->setApplicationName(env('GOOGLE_APPLICATION_NAME'));
        $client->setIncludeGrantedScopes(true);
        $client->setAccessType('offline');

        $guzzleClient = new \GuzzleHttp\Client(array('curl' => array(CURLOPT_SSL_VERIFYPEER => false)));
        $client->setHttpClient($guzzleClient);

        $this->client = $client;
        $this->service = new Google_Service_Calendar($this->client);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $calendarList  = $this->service->calendarList->listCalendarList();
        
        $tasks = Announcement::all();
        return view('calendar.index', compact('tasks', 'calendarList'));
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
        //Validate request
        $this->validate($request, [
            'title' => 'required',
            'calendar' => 'required'
        ]);

        //Save to DB
        // $announcements = new Announcement();
        // $announcements->title = $request->title;
        // $announcements->start_date = $request->startDate;
        // $announcements->end_date = $request->endDate;
        // $announcements->save();

        //Save to GCalendar
        $calendarId = $request->calendar;
        //RFC 3339 DateTime for Google API
        $RFCstartTime = Carbon::parse($request->startDate.' '.$request->startTime, "Asia/Jakarta");
        $RFCendTime = Carbon::parse($request->endDate.' '.$request->endTime, "Asia/Jakarta");

        //Request didnt have time inputted
        if ($request->endTime != null && $request->startTime != null) {
            //Attaching Google Meet Link
            if ($request->addMeetCheckbox != 0) {
                $randomString = substr(md5(mt_rand()), 0, 10);

                $event = new Google_Service_Calendar_Event([
                    'summary' => $request->title,
                    'description' => $request->desc,
                    'colorId' => $request->colorId,
                    'start' => ['date' => $request->startDate],
                    'end' => ['date' => $request->endDate],
                    'reminders' => ['useDefault' => true],
                ]);

                $randomString = substr(md5(mt_rand()), 0, 10);

                $conferenceData = new Google_Service_Calendar_ConferenceData();

                //Conference Key
                $conferenceKey = new Google_Service_Calendar_ConferenceSolutionKey();
                $conferenceKey->setType("hangoutsMeet");
                
                $req = new Google_Service_Calendar_CreateConferenceRequest();
                $req->setRequestId($randomString); //set random String
                $req->setConferenceSolutionKey($conferenceKey);

                $conferenceData->setCreateRequest($req);
                $event->setConferenceData($conferenceData);

                $results = $this->service->events->insert($calendarId, $event, ['conferenceDataVersion' => 1]);
                
                // if (!$results) {
                //     return response()->json(['status' => 'error', 'message' => 'Something went wrong']);
                // }
                // return response()->json(['status' => 'success', 'message' => 'Event Created']);
            //Not Attaching Google Meet Link
            } else {
                $event = new Google_Service_Calendar_Event([
                    'summary' => $request->title,
                    'description' => $request->desc,
                    'colorId' => $request->colorId,
                    'start' => ['date' => $request->startDate],
                    'end' => ['date' => $request->endDate],
                    'reminders' => ['useDefault' => true],
                ]);

                $results = $this->service->events->insert($calendarId, $event);
            }
        //Request have time inputted
        } else {
            //Attaching Google Meet Link
            if ($request->addMeetCheckbox != 0) {
                $event = new Google_Service_Calendar_Event([
                    'summary' => $request->title,
                    'description' => $request->desc,
                    'colorId' => $request->colorId,
                    'start' => ['dateTime' => $RFCstartTime],
                    'end' => ['dateTime' => $RFCendTime],
                    'reminders' => ['useDefault' => true],
                ]);

                $randomString = substr(md5(mt_rand()), 0, 10);

                $conferenceData = new Google_Service_Calendar_ConferenceData();
                
                //Conference Key
                $conferenceKey = new Google_Service_Calendar_ConferenceSolutionKey();
                $conferenceKey->setType("hangoutsMeet");
                
                $req = new Google_Service_Calendar_CreateConferenceRequest();
                $req->setRequestId($randomString); //set random String
                $req->setConferenceSolutionKey($conferenceKey);
                
                $conferenceData->setCreateRequest($req);
                $event->setConferenceData($conferenceData);

                $results = $this->service->events->insert($calendarId, $event, ['conferenceDataVersion' => 1]);
 
            //Not Attaching Google Meet Link
            } else {
                $event = new Google_Service_Calendar_Event([
                    'summary' => $request->title,
                    'description' => $request->desc,
                    'colorId' => $request->colorId,
                    'start' => ['dateTime' => $RFCstartTime],
                    'end' => ['dateTime' => $RFCendTime],
                    'reminders' => ['useDefault' => true],
                ]);

                $results = $this->service->events->insert($calendarId, $event);
            }
        }
        // Announcement::create([
        //     'title' => $request->title,
        //     'start_date' => $request->startDate,
        //     'end_date' => $request->endDate
        // ]);

        // Announcement::create($request->all());
        if(!$results) {
            return redirect('/calendar')->with('error', 'An error occured.');
        } else {
            return redirect('/calendar')->with('success', 'Announcement successfully added.');
        }
        
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

    // public function initializeMeet() {
    //     $randomString = substr(md5(mt_rand()), 0, 10);

    //     $conferenceData = new Google_Service_Calendar_ConferenceData();

    //     //Conference Key
    //     $conferenceKey = new Google_Service_Calendar_ConferenceSolutionKey();
    //     $conferenceKey->setType("hangoutsMeet");
        
    //     $req = new Google_Service_Calendar_CreateConferenceRequest();
    //     $req->setRequestId($randomString); //set random String
    //     $req->setConferenceSolutionKey($conferenceKey);

    //     $conferenceData->setCreateRequest($req);
    //     $this->event->setConferenceData($conferenceData);
    // }
}
