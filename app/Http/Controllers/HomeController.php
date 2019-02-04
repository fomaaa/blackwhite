<?php

namespace App\Http\Controllers;

use App;
use View;
use Mail;
use Validator;
use Session;
use App\Http\Requests;
use Illuminate\Http\Request;
use App\Models\City;
use App\Models\Client;
use App\Models\Review;
use App\Models\Comment;
use App\Models\Personal_status;
use App\Models\Status;
use App\Models\Reset;
use App\User;
use App\Role;
use App\Models\Upload;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Input;
use Dwij\Laraadmin\Models\LAConfigs;
use Dwij\Laraadmin\Models\Module;
use Dwij\Laraadmin\Models\ModuleFields;


class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        session_start();
        $location = $this->_getLocation();

        App::setLocale($location);
        $fp = LAConfigs::where('key', 'sitename_part2')->first();
        
        View::share ( 'footer_phone', $fp->value );        
        View::share ( 'location', $location);        
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

    public function error() {
        return view('layouts/error');
    }
    public function editStatus(request $request)
    {
        $status = $request->status;
        $user_id = Auth::user()->id;
        $client_id = $request->client;

        $res = Personal_status::updateOrCreate([
            'user' => $user_id,
            'client' => $client_id,
        ] , [
            'status' => $status
        ] );


        return $res;
    }

    public function resetPassword() {
        return view('auth/passwords/reset');
    }

    public function newPassword(request $request) {

        $this->validate($request,[
            'email' => 'required|email|max:255',
        ]);

        $user = User::where('email', $request->email)->first();

        if ($user && $user->type != 'Admin' && $user->type != 'SuperAdmin') {
            $hash  = md5(date('YmdY') . $request->email . (time()*rand(0, 228)));

            Reset::updateOrCreate([
                'email' => $request->email,
            ] , [
                'token' => $hash
            ] );  
            $link = url('/') . '/new-password?token=' . $hash; 


            $res = Mail::send('emails.reset', ['user' => $user, 'link' => $link], function ($m) use ($user) {
                $m->from('bortsov-dev@mail.ru', 'Black/White List');

                $m->to($user->email, $user->name)->subject('Restore password');
            });

            return view('layouts/message', ['message' => trans('message.check_email')]);

        } else {
             return redirect()->back()->withErrors('This user does not exist');
        }
    }

    public function createPassword(request $request) {
        if ($request->token) {

            $check = Reset::where('token', $request->token)->first();
            if ($check) {
                return view('auth/new', ['token' => $request->token]);
            } else {
                return redirect('/restore')->withErrors('Something went wrong');
            }
        } else {
            return redirect('/restore')->withErrors('Something went wrong');
        }

    }
    public function destroyReview(request $request) {
        if(Module::hasAccess("Reviews", "delete") && $request->id) {
            Review::find($request->id)->delete();
            
            // Redirecting to index() method
            return array('status' => 'true');
        } 
    }

    public function destroyComment(request $request) {
        if(Module::hasAccess("Comments", "delete") && $request->id) {
            Comment::find($request->id)->delete();
            
            // Redirecting to index() method
            return array('status' => 'true');
        }
    }


    public function createNewPassword(request $request) {
        $this->validate($request,[
            'password' => 'required|min:6|confirmed',
        ]);
        $check = Reset::where('token', $request->token)->first();

        if ($check) {
            $user = User::where('email', $check->email)->first();
            if ($user) {
                $user->update([
                    'password' => bcrypt($request->password),
                ]);
                Reset::where('token', $request->token)->forceDelete();

                Session::flash('message', trans('message.suc_password'));
                return redirect()->guest('/login');
            } else {
                return redirect('/restore')->withErrors(trans('message.sww'));
            }
        } else {
            return redirect('/restore')->withErrors(trans('message.sww'));
        }
    }

    public function registration() {
        return view('auth/register');
    }
    public function create_girl(request $request) {
        $this->validate($request,[
            'name' => 'required|max:255|unique:users',
            'email' => 'required|email|max:255|unique:users',
            'password' => 'required|min:6|confirmed',
            'phone' => 'required|min:10',
        ]);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => bcrypt($request->password),
            'type' => 'Girl',
            'is_ban' => 1,
            'phone' => $request->phone,
            'created' => date("Y-m-d H:i:s"),
        ]);
        $user->detachRoles();
        $role = Role::find(2);
        $user->attachRole($role);
        
        return view('layouts/error');
    }

    public function clients(request $request) 
    {
        $client = new Client();
        $client = $client->where('id', $request->id)->get();
        $data = array();

        if (!empty($client[0])) {
            $data['client_id'] = $client[0]->id;
            $data['date_add'] = $client[0]->created_at;
            $data['phone'] = $client[0]->phone;
            $data['email'] = $client[0]->email;
            $data['reviews'] = array();
            $data['mark'] = Personal_status::where('client',$client[0]->id)->where('user', Auth::user()->id)->first();

            if ($data['mark']) {
                $data['mark'] = $data['mark']->status;
            } else {
                if ($this->_getLocation() == 'en') {
                    $data['mark'] = 'You can leave a personal note for this user.';
                } else {
                    $data['mark'] = 'Вы можете оставить личную пометку для этого пользователя';
                }
            }

            $reviews = new Review();
            $data['reviews'] = $reviews->where('client', $client[0]->id)->get();
            $reviewCount = count($data['reviews']);
            // dd($data['reviews']);
            $commentsCount = 0;
            if (!empty($data['reviews'][0])) {
                $comments = new Comment;
                $status = new Status;
                $user = new User;
                foreach($data['reviews'] as $key => $review) {
                    // dd($review);
                    $review->status = $status->where('id', $review->status)->first();
                    if ($user) {
                        $review->author = $user->where('id', $review->author)->first();
                    } 
                    $review->address =  City::where('id', $review->address)->first();
                    $data['reviews'][$key]['comments'] = $comments->where('review', $review->id)->get();

                    foreach ($data['reviews'][$key]['comments'] as $index => $comment) {
                        $user = User::where('id', $data['reviews'][$key]['comments'][$index]->user)->first();

                        if ($user) {
                            $data['reviews'][$key]['comments'][$index]->user = $user->name;
                            
                        } else {
                            $data['reviews'][$key]['comments'][$index]->user = "Anonymously";
                        }
                    }

                    $commentsCount+= count($data['reviews'][$key]['comments']);
                }
            }

            
            $data['commentsCount'] = $commentsCount;
            $data['reviewCount'] = $reviewCount;

            return view('front/client', ['data' => $data]);
        } else {
             return abort(404);
        }


    }

    public function addComment(request $request) 
    {
        $review_id = $request->review_id;
        $comment = $request->comment;
        $is_anon = $request->is_anon;
        $is_anon ? $is_anon = "Yes" : $is_anon = 'No';
        $comment = Comment::create([
            'review' => $review_id,
            'comment' => $comment,
            'anon' => $is_anon, 
            'user' => Auth::user()->id
        ]);

        $user = User::where('id', Auth::user()->id)->first();
        if ($user) {
            $review_count = $user->rev_count;
            $comment_count = $user->com_count;

            User::where('id', Auth::user()->id)->update([
                'com_count' => $comment_count +1,
            ]);

            
        }


        return $comment->id;
    }

    public function black() 
    {
        $cities = new City();
        $statuses = new Status();

       return view('front/black', [
            'cities' => $cities->get(),
            'statuses' => $statuses->get(),
        ]);

    } 

    public function white() 
    {
        $cities = new City();
        $statuses = new Status();

       return view('front/white', [
            'cities' => $cities->get(),
            'statuses' => $statuses->get(),
        ]);
    }

    public function whiteAdd(request $request) 
    {
        $phone = $request->phone;
        $email = $request->email;
        $address = $request->address;
        $links = $request->link;
        $description = $request->description;
        $author = $request->author;
        $user_id = Auth::user()->id;
        $mark = $request->mark;

        $photos =  $this->uploadFiles($request);
        $photos ? '' : $photos = "";

        if (!$phone && !$email) {
            if ($this->_getLocation() == 'en') {
                return redirect()->back()->withErrors('Phone or email required!');
            } else {
                return redirect()->back()->withErrors('Для размещения отзыва необходимо добавить телефон или email !');
            }
        }
        if ($phone) {
            if (strlen($phone) < 11) {
                if ($this->_getLocation() == 'en') {
                    return redirect()->back()->withErrors('You must enter 10 digits of the phone');
                } else {
                    return redirect()->back()->withErrors('Телефон не может быть меньше 10 цифр');
                } 
            }
        }

        if ($email) {
            if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                if ($this->_getLocation() == 'en') {
                    return redirect()->back()->withErrors('Valid email required!');
                } else {
                    return redirect()->back()->withErrors('Введите корректный email !');
                } 
            }
        }

        if ($phone) {
            $is_client  = Client::where('phone', $phone)->first();

            if (!$is_client && $email) {
                $is_client  = Client::where('email', $email)->first();
                if ($is_client) {
                    $is_client->update(['phone' => $phone]);
                }
            }
        } else if ($email) {
            $is_client  = Client::where('email', $email)->first();
        }


        if ($is_client) {
            $clientID =  $is_client->id;
        } else {
            $client = Client::create([
                'phone' => $phone,
                'email' => $email
            ]);

            $clientID = $client->id;
        }

        $user = User::where('id', $user_id)->first();

        if ($user) {
            $review_count = $user->rev_count;

            User::where('id', $user_id)->update([
                'rev_count' => $review_count +1,
            ]);

            
        }

        $review = Review::create([
            'phone' => $phone,
            'email' => $email,
            'address' => $address,
            'links' => $links,
            'review' => $description,
            'author' => $user_id,
            'list' => 'White',
            'anon' => $author,
            'client' => $clientID,
            'photos' => $photos
        ]);

        // if ($mark) {
        //     Personal_status::updateOrCreate([
        //         'user' => $user_id,
        //         'client' => $clientID,
        //     ] , [
        //         'status' => $mark
        //     ] );  
        // }

        return redirect('client/' . $clientID);
    }

    public function blackAdd(request $request) 
    {
        $phone = $request->phone;
        $email = $request->email;
        $address = $request->address;
        $link = $request->link;
        $description = $request->description;
        $status = $request->status;
        $author = $request->author;
        $mark = $request->mark;
        $links = $request->link;
        $user_id = Auth::user()->id;

        $photos =  $this->uploadFiles($request);
        $photos ? '' : $photos = "";

        if (!$phone && !$email) {
            if ($this->_getLocation() == 'en') {
                return redirect()->back()->withErrors('Phone or email required!');
            } else {
                return redirect()->back()->withErrors('Для размещения отзыва необходимо добавить телефон или email !');
            }
        }

        if ($phone) {
            if (strlen($phone) < 11) {
                if ($this->_getLocation() == 'en') {
                    return redirect()->back()->withErrors('You must enter 10 digits of the phone');
                } else {
                    return redirect()->back()->withErrors('Телефон не может быть меньше 10 цифр');
                } 
            }
        }

        if ($email) {
            if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                if ($this->_getLocation() == 'en') {
                    return redirect()->back()->withErrors('Valid email required!');
                } else {
                    return redirect()->back()->withErrors('Введите корректный email !');
                } 
            }
        }
        
        if ($phone) {
            $is_client  = Client::where('phone', $phone)->first();

            if (!$is_client && $email) {
                $is_client  = Client::where('email', $email)->first();
                if ($is_client) {
                    $is_client->update(['phone' => $phone]);
                }
            }
        } else if ($email) {
            $is_client  = Client::where('email', $email)->first();
        }

        if ($is_client) {
            $clientID =  $is_client->id;
        } else {
            $client = Client::create([
                'phone' => $phone,
                'email' => $email
            ]);

            $clientID = $client->id;
        }
        $review = Review::create([
            'phone' => $phone,
            'email' => $email,
            'address' => $address,
            'links' => $links,
            'review' => $description,
            'status' => $status,
            'author' => $user_id,
            'list' => 'Black',
            'client' => $clientID,
            'anon' => $author,
            'photos' => $photos
        ]);

        $user = User::where('id', $user_id)->first();
        if ($user) {
            $review_count = $user->rev_count;

            User::where('id', $user_id)->update([
                'rev_count' => $review_count +1,
            ]);
        }
        // if ($mark) {
        //     Personal_status::updateOrCreate([
        //         'user' => $user_id,
        //         'client' => $clientID,
        //     ] , [
        //         'status' => $mark
        //     ] );  
        // }

        return redirect('client/' . $clientID);
    }


    public function checkByPhone(request $request) 
    {
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
    public function checkByEmail(request $request) 
    {
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


    private function uploadFiles($request) 
    {
        $input = Input::all();

        $photos = Input::file('photos');
        $folder = storage_path('uploads');
        $date_append = date("Y-m-d-His-");

        if ($photos[0]) {
            foreach ($photos as $photo) {
                $filename = $photo->getClientOriginalName();
                $upload_success = $photo->move($folder, $date_append.$filename);

                if ($upload_success) {
                    $public = true;
                    $upload = Upload::create([
                            "name" => $filename,
                            "path" => $folder.DIRECTORY_SEPARATOR.$date_append.$filename,
                            "extension" => pathinfo($filename, PATHINFO_EXTENSION),
                            "caption" => "",
                            "hash" => "",
                            "public" => $public,
                            "user_id" => Auth::user()->id
                    ]);

                    while(true) {
                        $hash = strtolower(str_random(20));
                        if(!Upload::where("hash", $hash)->count()) {
                            $upload->hash = $hash;
                            break;
                        }
                    }
                    $upload->save();

                    $upload_file[] = $upload->id;

                }
            }
            
            return '[' . implode(',', $upload_file) . ']';
        }

    }

    public function setLocaleRU()
    {
        $_SESSION['location'] = 'ru';

        return \App::make('redirect')->back();
    }

    public function setLocaleEN() 
    {
         $_SESSION['location'] = 'en';

         return \App::make('redirect')->back();
    }

    private function _getLocation() 
    {
        isset($_SESSION['location']) ? $location = $_SESSION['location'] : $location = 'en';

        return $location;
    }
}



    