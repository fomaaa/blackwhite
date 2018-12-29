<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use Illuminate\Http\Request;
use App\Models\City;
use App\Models\Client;
use App\Models\Review;
use App\Models\Comment;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        //$this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('front.home');
    }

    public function login()
    {
        return view('auth/login');
    }
    public function check(){
        
        return view('front/check');
    }
    public function add() {

        return view('front/add');
    }
    public function clients(request $request) {
        $client = new Client();
        $client = $client->where('id', $request->id)->get();

        if (!empty($client[0])) {
            $data['client_id'] = $client[0]->id;
            $data['date_add'] = $client[0]->created_at;
            $data['phone'] = $client[0]->phone;
            $data['email'] = $client[0]->email;
            $data['reviews'] = array();

            $reviews = new Review();
            $data['reviews'] = $reviews->where('client', $client[0]->id)->get();
            if (!empty($data['reviews'][0])) {
            $comments = new Comment;
            foreach($data['reviews'] as $key => $review) {
                // $data['reviews'][$key]['comments']
            }

            }

            
        }
        dd($data);
        $data = array();



        return view('front/client');

    }
    public function black() {
        $cities = new City();
        $statuses = new Client_status();

       return view('front/black', [
            'cities' => $cities->get(),
            'statuses' => $statuses->get(),
        ]);

    } 
    public function white() {
        $cities = new City();
        $statuses = new Client_status();

       return view('front/white', [
            'cities' => $cities->get(),
            'statuses' => $statuses->get(),
        ]);
    }

    public function whiteAdd(request $request) {
        dd($request);
    }

    public function blackAdd(request $request) {
        dd($request);
    }


    public function checkByPhone(request $request) {
        if ($request->phone) {

            $clients = Client::where('phone', $request->phone)->get();

            if ($clients) {
                $html = view("layouts/check", ["clients" => $clients]);
            }

            return array(
                'status' => true,
                'html' => (string) $html,
                'count' => count($clients)
            );
        }
    }    
    public function checkByEmail(request $request) {
        if ($request->email) {

            $clients = Client::where('email', $request->email)->get();

            if ($clients) {
                $html = view("layouts/check", ["clients" => $clients]);
            }

            return array(
                'status' => true,
                'html' => (string) $html,
                'count' => count($clients)
            );
        }
    }
}
