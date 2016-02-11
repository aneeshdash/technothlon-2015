<?php

class HomeController extends BaseController {

	/*
	|--------------------------------------------------------------------------
	| Default Home Controller
	|--------------------------------------------------------------------------
	|
	| You may wish to use controllers instead of, or in addition to, Closure
	| based routes. That's great! Here is an example controller method to
	| get you started. To route to this controller, just add the route:
	|
	|	Route::get('/', 'HomeController@showWelcome');
	|
	*/

	public function home()
	{
		return View::make('layouts.home');
	}
    public function about()
    {
        return View::make('layouts.about');
    }
    public function contact()
    {
        return View::make('layouts.contact');
    }
    public function led()
    {
        return View::make('layouts.led');
    }
    public function technofin()
    {
        return View::make('layouts.technofin');
    }
    public function videos()
    {
        return View::make('layouts.videos');
    }
    public function downloads()
    {
        return View::make('layouts.downloads');
    }
    public function feedback()
    {
        return View::make('layouts.feedback');
    }
    public function postfeedback()
    {
        $name=Input::get('name');
        $email=Input::get('email');
        $suggestion=Input::get('suggestion');
        DB::table('feedback')->insert(array('name' => $name, 'email' => $email, 'suggestion' => $suggestion));
//        Queue::push(function ($job) use ($name, $email, $suggestion) {
            Mail::send('emails.feedback', array('name' => $name, 'email' => $email, 'suggestion' => $suggestion), function ($message) use ($name, $email) {
                $message->to('technothlon@techniche.org', 'Technothlon')->subject('New Feedback Received');
//            });
//            $job->delete;
        });
        return Redirect::route('home');
    }
    public function faqs()
    {
        return View::make('layouts.faqs');
    }
    public function technopedia()
    {

        return View::make('layouts.technopedia');
    }
    public function rollrecover()
    {
        return View::make('layouts.rollrecover');
    }
    public function postrollrecover()
    {
        $city_id=Input::get('city');
        $school_id=Input::get('school');
        $name1=Input::get('name1');
        $name2=Input::get('name2');
        if(User::where('city_id', $city_id)->where('name1','LIKE', "%$name1%")->where('name2','LIKE', "%$name2%")->count()) {
            $user=User::where('city_id', $city_id)->where('name1','LIKE', "%$name1%")->where('name2','LIKE', "%$name2%")->orderBy('id', 'desc')->first();
            return View::make('layouts.rolldetail')->with('user', $user);
        }
        else if(User::where('city_id', $city_id)->where('name2','LIKE', "%$name1%")->where('name1','LIKE', "%$name2%")->count()) {
            $user=User::where('city_id', $city_id)->where('name2','LIKE', "%$name1%")->where('name1','LIKE', "%$name2%")->orderBy('id', 'desc')->first();
            return View::make('layouts.rolldetail')->with('user', $user);
        }
        else {
            return View::make('layouts.rollnotfound');
        }
    }
    public function rollmail()
    {
        $user=User::find(Input::get('id'));
        $type=Input::get('type');
        $password=str_random(6);
        $user->password=Hash::make($password);
        $user->save();
        $school=School::find($user->school_id);
        $city=City::find($user->city_id);
        $state=State::find($city->state_id);
        if($type == '0' || $type == '1') {
            if($user->email1 !== "") {
                Queue::push(function($job) use ($user, $password, $school, $city, $state) {
                    Mail::send('emails.offline', array('user' => $user, 'school' => $school, 'city' => $city, 'state' => $state, 'password' => $password, 'name' => $user->name1) , function($message) use ($user) {
                        $message->to($user->email1, $user->name1)->subject('Technothlon Registration Details');
                    });
                    $job->delete;
                });
            }
        }
        if($type == '0' || $type == '2') {
            if($user->email2 !== "") {
                Queue::push(function ($job) use ($user, $password, $school, $city, $state) {
                    Mail::send('emails.offline', array('user' => $user, 'school' => $school, 'city' => $city, 'state' => $state, 'password' => $password, 'name' => $user->name2), function ($message) use ($user) {
                        $message->to($user->email2, $user->name2)->subject('Technothlon Registration Details');
                    });
                    $job->delete;
                });
            }
        }
        return 1;
//        return View::make('emails.rollmail');
    }
    public function pques($month=null)
    {
        if($month==null) {
            return View::make('technopedia.months');
        }
        else {
            $month_no=intval(date('m',strtotime($month))) -1;
            Session::put('index',10*$month_no+1);
            $question = DB::table('technopedia_ques')->where('id',Session::get('index'))->first();
            return View::make('technopedia.prevques')->with('month',$month)->with('question',$question);
        }
    }
//    public function pques()
//    {
//        $month_no=intval(date('m',strtotime($month))) -1;
//        Session::put('index',10*$month_no+1);
//        return View::make('technopedia.prevques')->with('index',10*$month_no+1);
//    }
    public function postpques() {
        if(Input::get('response')==='Previous')
        {
            Session::put('index',Session::get('index')-1);
            return View::make('technopedia.prevques');
        }
        else if(Input::get('response')==='Next')
        {
            Session::put('index',Session::get('index')+1);
            return View::make('technopedia.prevques');
        }
        Session::put('response',Input::get('response'));
        Session::put('index',Session::get('index'));
        return View::make('technopedia.pewvques');
    }
    public function leaderboard()
    {
        $table='';
        $months=array('April','March','February','January');
        foreach($months as $month) {
            $table .= '<h3 style="margin-bottom: 0px">'.$month.'</h3>
    <table class="rwd-table">
        <tr>
            <th>Rank</th>
            <th>Name 1</th>
            <th>Name 2</th>
            <th>City</th>
        </tr>';
            $users=DB::table('technopedia_response')->where('month',$month)->orderBy('score','desc')->take(10)->get();
            for($rank=0;$rank<10;$rank++)
            {
                $user=User::where('roll',$users[$rank]->roll)->first();
                $citi=City::where('id',$user->city_id)->first();
                $city=$citi->name;
//                $city=$user->roll;
                $table .= ' <tr>
            <td>'.($rank+1).'</td>
            <td>'.strtoupper($user->name1).'</td>
            <td>'.strtoupper($user->name2).'</td>
            <td>'.$city.'</td>
        </tr>';
//                $table .= $users[$rank]->roll.'<br>';
            }
            $table .= ' </table><br><br>';
        }
        return View::make('technopedia.leaderboard')->with('table',$table);
    }
    public function technopedialogin()
    {
        return View::make('technopedia.login');
    }
    public function posttechnopedialogin()
    {
        $roll = Input::get('roll');
        $password = Input::get('password');
        $user = array(
            'roll' => $roll,
            'password' => $password
        );

        if(Auth::user()->attempt($user)) {
            return Redirect::intended('/');
        }
        else {
            if(User::where('roll',$roll)->count()) {
                $user = User::where('roll',$roll)->first();
                if($user->result_pass == Crypt::encrypt($password)) {
                    Auth::user()->login($user);
                    return Redirect::intended('/');
                }
                return Redirect::route('technopedialogin')->with('error', 'Incorrect Password')->withInput();
            }
        }
        return Redirect::route('technopedialogin')->with('error', 'Incorrect combination of roll number and password')->withInput();
    }
    public function forgot() {
        return View::make('technopedia.forgot');
    }
    public function postforgot() {
        $roll = Input::get('roll');
        $input['email'] = $roll;
        $rules = array('email' => 'unique:registrations,roll');
        $validator = Validator::make($input, $rules);
        if ($validator->fails()) {
            $user=User::where('roll', $roll);
            $password=str_random(6);
            $user->password=Hash::make($password);
            $user->save();
            if($user->email1 !== "") {
                Queue::push(function($job) use ($user, $password) {
                    Mail::send('emails.reset', array('user' => $user,'password' => $password, 'name' => $user->name1) , function($message) use ($user) {
                        $message->to($user->email1, $user->name1)->subject('Technothlon Password Reset');
                    });
                    $job->delete;
                });
            }
            if($user->email1 !== "") {
                Queue::push(function($job) use ($user, $password) {
                    Mail::send('emails.reset', array('user' => $user,'password' => $password, 'name' => $user->name2) , function($message) use ($user) {
                        $message->to($user->email2, $user->name2)->subject('Technothlon Password Reset');
                    });
                    $job->delete;
                });
            }
            return Redirect::route('technopedialogin');
        }
        else {
            return Redirect::route('forgot')->with('error', 'Roll number doesnot exist. Please check again.');
        }
    }
    public function question() {
        $ques=Session::get('question', '0');
        $wrong=Session::get('wrong', '0');
        $score=Session::get('score', '0');
        $prev=date("m").strval($ques);
        if(intval($ques) !== 0) {
            $res=Input::get('response');
            $answer=DB::table('technopedia_ques')->where('ques_id', $prev)->pluck('answer');
            if($res !== $answer) {
                $wrong = intval($wrong)+1;
                $score = intval($score)-intval($ques);
                if(intval($wrong) === 3) {
                    Session::forget('question');
                    Session::forget('wrong');
                    Session::forget('score');
                    DB::table('technopedia_response')->update(array('score' => $score));
                    return Redirect::route('endtechnopedia')->with('score', $score);
                }
            }
            else {
                $score = intval($score)+ pow(intval($ques),2);
                if($ques == '10') {
                    return Redirect::route('endtechnopedia')->with('score', $score);
                }
            }
        }
        else {
            if(DB::table('technopedia_response')->where('month','February')->where('roll', Auth::user()->get()->roll)->count() === 1) {
                return View::make('technopedia.attempted');
            }
            DB::table('technopedia_response')->insert(array('roll' => Auth::user()->get()->roll));
        }
        Session::put('question', strval(intval($ques)+1));
        Session::put('wrong', $wrong);
        Session::put('score', $score);
        $id=date("m").strval(Session::get('question'));
        $question=DB::table('technopedia_ques')->where('ques_id', $id)->pluck('body');
        return View::make('technopedia.question')->with('body', $question);
    }
    public function question2() {
        return View::make('technopedia.question');
    }
    public function starttechnopedia() {
        if(DB::table('technopedia_response')->where('roll', Auth::user()->get()->roll)->count() === 1) {
            return View::make('technopedia.attempted');
        }
        return View::make('technopedia.starttechnopedia');
    }
    public function endtechnopedia() {
        return View::make('technopedia.endtechnopedia');
    }
    public function logout()
    {
        Auth::user()->logout();
        return Redirect::route('home');
    }
    public function register()
    {
        return View::make('layouts.register');
    }
    public function registrations()
    {
        return View::make('layouts.registrations');
    }
    public function postregister()
    {
        $rules=array(
            'state' => 'required',
            'city' => 'required',
            'other_city' => 'required_if:city,other',
            'centre' => 'required_if:city,other',
            'school' => 'required',
            'name' => "required_if:school,other|string",
            'addr1' => 'required_if:school,other',
            'pincode' => 'required_if:school,other|digits:6',
            'contact' => 'required_if:school,other',
            'squad' => 'required',
            'language' => 'required',
            'name1' => "required|Regex:/^[\\p{L} .'-]+$/",
            'email1' => 'required|email',
            'contact1' => 'required|numeric',
            'name2' => "required|Regex:/^[\\p{L} .'-]+$/",
            'email2' => 'required|email',
            'contact2' => 'required|numeric'
        );

        $messages=array(
            'name.regex' => 'School name can have words, commas, dashes, single quotes and dots.',
            'pincode.digits' => 'Pincode can have exactly 6 digits.',
            'contact.numeric' => 'School contact can have only digits.',
            'name1.regex' => 'Name of Particpant 1 can have words, commas, dashes, single quotes and dots.',
            'contact1.numeric' => 'Contact of Participant 1 can have only digits.',
            'email1.email' => 'Email ID of Participant 1 has to be a valid email address.',
            'name2.regex' => 'Name of Particpant 2 can have words, commas, dashes, single quotes and dots.',
            'contact2.numeric' => 'Contact of Participant 2 can have only digits.',
            'email2.email' => 'Email ID of Participant 2 has to be a valid email address.',
        );

        $validator = Validator::make(Input::all(), $rules, $messages);
        if ($validator->fails())
        {
            Input::flash();
            return Redirect::to('register')->withErrors($validator)->withInput();
        }
        else {
            if(Input::get('city') === 'other') {
                $city=new City();
                $city->name=ucwords(strtolower(Input::get('other_city')));
                $city->state_id=Input::get('state');
                $state=State::where('id', Input::get('state'))->first();
                $city->region=$state->region;
//                $code=City::where('region', $state->region)->orderBy('code', 'desc')->first();
//                $city->code=($code->code) + 1;
                $city->save();
                $cities=City::where('name', Input::get('other_city'))->orderBy('id', 'desc')->first();
                $city=$cities->id;
            }
            else {
                $city=Input::get('city');
            }
            if(Input::get('centre') !== "") {
                $centre=Input::get('centre')*10;
            }
            else {
                $centre=$city*10;
            }
            if(Input::get('school') === 'other') {
                $school=new School();
                $school->name=strtoupper(Input::get('name'));
                $school->address=strtoupper(Input::get('addr1').', '.Input::get('addr2'));
                $school->pincode=Input::get('pincode');
                $school->contact=Input::get('contact');
                $school->email=Input::get('email');
                $school->city_id=$city;
                $school->save();
                $schools=School::where('name', Input::get('name'))->orderBy('id', 'desc')->first();
                $school=$schools->id;
            }
            else {
                $school=Input::get('school');
            }
            $user= new User;
            $user->name1=strtoupper(Input::get('name1'));
            $user->email1=Input::get('email1');
            $user->contact1=Input::get('contact1');
            $user->name2=strtoupper(Input::get('name2'));
            $user->email2=Input::get('email2');
            $user->contact2=Input::get('contact2');
            $user->squad=Input::get('squad');
            $user->school_id=$school;
            $user->language=Input::get('language');
            $user->city_id=$city;
            $user->centre_id=$centre;
            $roll="";
            if(Input::get('squad') === 'JUNIOR') {
                $roll="J";
            }
            else {
                $roll="H";
            }
            if(Input::get('language') === 'en') {
                $roll .= "E";
            }
            else {
                $roll .= "H";
            }
            $centre_id=City::where('id', $centre/10)->orderBy('id')->first();
//            $code=$centre_id->id;
            $roll .= $centre_id->code;
            $roll .= 1;
            $lastroll=User::withTrashed()->where('roll', 'LIKE', "%$roll%")->count();
            $roll .= str_pad(strval($lastroll+1), 4, "0", STR_PAD_LEFT);
            $user->roll=$roll;
            $user->year=2015;
            $password=str_random(6);
            $user->password=Hash::make($password);
            $user->save();
            $school=School::find($user->school_id);
            $city=City::find($user->city_id);
            $state=State::find($city->state_id);
            Mail::send('emails.registered', array('user' => $user, 'school' => $school, 'city' => $city, 'state' => $state, 'password' => $password, 'name' => $user->name1) , function($message) use ($user) {
               $message->to($user->email1, $user->name1)->subject('Technothlon Registration Details');
            });
            Mail::send('emails.registered', array('user' => $user, 'school' => $school, 'city' => $city, 'state' => $state, 'password' => $password, 'name' => $user->name2) , function($message) use ($user) {
                $message->to($user->email2, $user->name2)->subject('Technothlon Registration Details');
            });
            Input::flush();
//            return Redirect::route('home');
            return View::make('layouts.registersuccess')->with('user', $user);
        }
    }
    public function getcities()
    {
        $state=Input::get('state');
        return View::make('function.getcities')->with('state', $state);
    }
    public function citywcrep()
    {
        $state=Input::get('state');
        return View::make('function.citywcrep')->with('state', $state);
    }
    public function getcityrep()
    {
        $city=Input::get('city');
        return View::make('function.getcityrep')->with('city', $city);
    }
    public function schoollist()
    {
        $city=Input::get('city');
        return View::make('function.schoollist')->with('city', $city);
    }
    public function cityrep_present()
    {
        $city=Input::get('city');
        $city = City::find($city);
        if($city->online == 1)
            return 0;
        return CityRep::where('city_id',$city->id)->count();
        return View::make('function.cityrep_present')->with('city', $city);
    }
    public function test()
    {
        $text='<table>';
        for($i=1; $i<=447; $i++) {
            $user=User::where('roll','JE1181'.str_pad(strval($i+1), 4, "0", STR_PAD_LEFT))->first();
            $password=str_random(6);
            $user->password=Hash::make($user->password);
            $user->save();
//            $text .= '<tr><td>'.$user->roll.'</td><td> '.$password.'</td><br>';
        }
//        return View::make('layouts.test')->with('month', $month);
//        $text='<table>';
//        foreach(User::where('school_id',1)->get() as $user)
//        {
//            $password=str_random(6);
//            $hash=Hash::make($password);
//            $user->password=$hash;
//            $user->save();
//            $text .= '<tr><td>'.$user->roll.'</td><td> '.$password.'</td><br>';
//        }
//        $password=str_random(6);
//        $hash=Hash::make($password);
//        return View::make('layouts.test3', array('hash' => $hash, 'password' => $password));
//        $error='';
//        foreach(School::all() as $school) {
//            if(School::where('name',$school->name)->where('verified','>',0)->count() >1 && School::where('name',$school->name)->count()==School::where('name',$school->name)->where('id','>=',$school->id)->count()) {
//                $city=City::where('id',$school->city_id)->first();
//                $error .= $school->name.'<br>';
//
//            }
//        }
//        $ques= DB::table('technopedia_ques')->where('ques_id', '0310')->first();
        $text .= '</table>';
        return View::make('layouts.test')->with('body',$text);
    }
    public function test2()
    {
        $error="";
        $regs = DB::table('registration')->get();
        foreach ($regs as $reg) {
            $user=new User();
            $user->name1=strtoupper($reg->name1);
            $user->name2=strtoupper($reg->name2);
            $user->email1=$reg->email1;
            $user->email2=$reg->email2;
            $user->contact1=$reg->contact1;
            $user->contact2=$reg->contact2;
            $user->squad=$reg->squad;
            $user->language=$reg->language;
            $school=strtoupper($reg->school);
            $city_name = ucwords(strtolower($reg->city));
            if(School::where('name', $school)->count() && City::where('name', $city_name)->count()) {
                $cityid = City::where('name', $city_name)->first();
                $school_name=School::where('name', $school)->where('city_id',$cityid->id)->first();
                $user->school_id=$school_name->id;
                $user->city_id = $cityid->id;
                $user->centre_city=$cityid->id * 10;
                $roll="";
                if($reg->squad === 'JUNIOR') {
                    $roll="J";
                }
                else {
                    $roll="H";
                }
                if($reg->language === 'en') {
                    $roll .= "E";
                }
                else {
                    $roll .= "H";
                }
                $roll .= strval($cityid->code).'0';
                $lastroll=User::withTrashed()->where('roll', 'LIKE', "%$roll%")->count();
                $roll .= str_pad(strval($lastroll+1), 4, "0", STR_PAD_LEFT);
                $user->roll=$roll;
                $user->year=2015;
                $user->paid = true;
                $user->comments = $reg->comments;
                $user->save();
                }
            else {
                if(School::where('name', $school)->count()) {
                    $error .= $city_name.'<br>';
                }
                elseif(City::where('name', $city_name)->count()) {
                    $error .= $school.'<br>';
                }
                else {
                    $error .= $school.'   '.$city_name;
                }
            }
        }
//        Auth::logout();
        return View::make('layouts.test3')->with('error', $error);
    }
    public function schoolapprove()
    {
        return View::make('layouts.school_approve');
    }
    public function schoolupdate()
    {
        $school=School::find(Input::get('id'));
        $school->name=Input::get('name');
        $school->address=Input::get('addr');
        $school->pincode=Input::get('pincode');
        $school->contact=Input::get('contact');
        $school->verified=1;
        $school->save();
    }
    public function schoolreplace()
    {
        $school=School::find(Input::get('originalid'));
        foreach(User::where('school_id', Input::get('originalid'))->get() as $user) {
            $user->school_id=Input::get('newid');
            $user->save();
        }
        $school->comments="Replaced by school with id=".Input::get('newid');
        $school->delete();
    }
//    public function registered() {
//        $user=User::find(23);
//        return View::make('layouts.registersuccess')->with('user', $user);
//    }
    public function citymail() {
        return View::make('emails.city_email');
    }
    public function postcitymail() {
        $cityid=Input::get('city');
        $password='password';
        foreach(User::where('city_id', $cityid)->get() as $user) {
            if(substr($user->roll, -5, 1) === '0') {
                if($user->email1 !== "") {
                    Mail::send('emails.testmail', array('user' => $user) , function($message) use ($user) {
                        $message->to($user->email1, $user->name)->subject('Technothlon Registration Details');
                    });
                }
                if($user->email2 !== "") {
                    Mail::send('emails.testmail', array('user' => $user) , function($message) use ($user) {
                        $message->to($user->email2, $user->name2)->subject('Technothlon Registration Details');
                    });
                }
            }
            }
    }
    public function regmail() {
        $error="";
        foreach(User::whereRaw('id BETWEEN 1 AND 200')->get() as $user) {
            if(substr($user->roll, -5, 1) === '0') {
                $password=str_random(6);
                $user->password=Hash::make($password);
                $user->save();
                $school=School::find($user->school_id);
                $city=City::find($user->city_id);
                $state=State::find($city->state_id);
                if($user->email1 !== "") {
                    Queue::push(function($job) use ($user, $password, $school, $city, $state) {
                        Mail::send('emails.offline', array('user' => $user, 'school' => $school, 'city' => $city, 'state' => $state, 'password' => $password, 'name' => $user->name1) , function($message) use ($user) {
                            $message->to($user->email1, $user->name1)->subject('Technothlon Registration Details');
                        });
                        $job->delete;
                    });
                }
                if($user->email1 !== "") {
                    Queue::push(function($job) use ($user, $password, $school, $city, $state) {
                        Mail::send('emails.offline', array('user' => $user, 'school' => $school, 'city' => $city, 'state' => $state, 'password' => $password, 'name' => $user->name2) , function($message) use ($user) {
                            $message->to($user->email2, $user->name2)->subject('Technothlon Registration Details');
                        });
                        $job->delete;
                    });
                }
            }
        }
        return View::make('layouts.test')->with('error', $error);
    }
    public function test3() {
        $user=User::find(1);
        $password=str_random(6);
        $school=School::find($user->school_id);
        $city=City::find($user->city_id);
        $state=State::find($city->state_id);
        $name="Aneesh Dash";
        $to = "Aneesh Dash<aneeshdash@yahoo.co.in>";
        $subject = "Technothlon Registration Details";

        $message = "
        <html lang='en'>
        <head>
    <meta charset='UTF-8'>
    <title>Technothlon Registration Details</title>
    </head>
    <body>
    <div style='display: table; margin: 0 auto'>
    <div style='text-align: center'>
        <img src='technothlon.png'; width='300px'>
    </div><br><br>
    <div style='display: inline-block'>
        Dear".$name.",<br>
        You have successfully registered for Technothlon 2015 with the following details: <br><br>
        <div id='school'>
            <div style='display: inline-block'>
                <div>
                    School Name:
                </div>
                <div>
                    School Address:
                </div>
                <div>
                    City:
                </div>
                <div>
                    State
                </div>
            </div>
            <div style='display: inline-block; margin-left: 10px'>
                <div>
                    ".$school->name."
                </div>
                <div>
                    ".$school->address."
                </div>
                <div>
                    ".$city->name."
                </div>
                <div>
                    ".$state->name."
                </div>
            </div>
        </div>
        <div><br>
            <div style='display: inline-block'>
                Squad: {{ $user->squad }}
            </div>
            <div style='display: inline-block; margin-left: 20px'>
                Medium: {{ $user->language }}
            </div>
        </div><br>
        <div id='details'>
            <div style='display: inline-block'>
                <div style='display: inline-block'>
                    <div>
                        Name:
                    </div>
                    <div>
                        Email:
                    </div>
                    <div>
                        Contact:
                    </div>
                </div>
                <div style='display: inline-block; margin-left: 10px'>
                    <div>
                        ".$user->name1."
                    </div>
                    <div>
                        ".$user->email1."
                    </div>
                    <div>
                        +91".$user->contact1."
                    </div>
                </div>
            </div>
            <div style='display: inline-block; margin-left: 20px'>
                <div style='display: inline-block'>
                    <div>
                        Name:
                    </div>
                    <div>
                        Email:
                    </div>
                    <div>
                        Contact:
                    </div>
                </div>
                <div style='display: inline-block; margin-left: 10px'>
                    <div>
                        ".$user->name2."
                    </div>
                    <div>
                        ".$user->email2."
                    </div>
                    <div>
                        +91".$user->contact2."
                    </div>
                </div>
            </div>
        </div>
    </div><br><br><br><br>
    <div id='roll'>
        Given below is your roll number and password which will be required for accessing technopedia<br> and other features of Technothlon.<br><br>
        <div style='display: inline-block;'>
            <div>Roll Number:</div>
            <div>Password:</div>
        </div>
        <div style='display: inline-block;'>
            <div>".$user->roll."</div>
            <div>".$password."</div>
        </div><br><br>
        <div id='details'>
            <ul>
                <li>The exam is on 19th July, 2015.</li>
                <li>Technopedia starts from the 15th of every month and ends on the 10th of next month.</li>
                <li>The first Technopedia starts from January</li>
                <li>In case of any discrepancy, <a href='http://technothlon.techniche.org/contact' target='_blank'>Contact Us</a>. </li>
            </ul>
        </div>
    </div>
</div>
</body>
</html>
        ";

        // Always set content-type when sending HTML email
        $headers = "MIME-Version: 1.0" . "\r\n";
        $headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";

        // More headers
        $headers .= 'From: Technothlon<noreply@technothlon.techniche.com>' . "\r\n";

        mail($to,$subject,$message,$headers);
    }
    public function registered() {
        return View::make('emails.registered');
    }

    public function admitcard()
    {
        if(Auth::user()->get()->centre_id == null && Centre::where('city_id',Auth::user()->get()->centre_city/10)->where('online','YES')->where('left','>',0)->count() > 0 && Auth::user()->get()->paid == 0) {
            $centre = Centre::where('city_id',Auth::user()->get()->centre_city/10)->where('online','YES')->where('left','>',0)->first();
            $user = Auth::user()->get();
            $user->centre_id = $centre->id;
            $user->result_pass = Crypt::encrypt(str_random(6));
            $user->save();
        }
        elseif(Auth::user()->get()->centre_id == null) {
            $text = 'You haven\'t been allotted a centre yet. Please check again in a day or two.<br>Or contact your City Representative.';
            return View::make('technopedia.admitcard')->with('text',$text);
        }
        if(! File::exists('admit-cards/users/'.Auth::user()->get()->roll.'.pdf')) {
            if(Auth::user()->get()->paid == 1) {
                $pdf = PDF::loadView('technopedia.offlineadmitcard')->save('admit-cards/users/'.Auth::user()->get()->roll.'.pdf');
            }
            else {
                $pdf = PDF::loadView('technopedia.onlineadmitcard')->save('admit-cards/users/'.Auth::user()->get()->roll.'.pdf');
            }
        }
        $text = '<a href="'.route('admitcarddown').'">Download</a>';
        return View::make('technopedia.admitcard')->with('text',$text);
    }

    public function admitcarddownload()
    {
        return Response::download('admit-cards/users/'.Auth::user()->get()->roll.'.pdf');
    }

    public function centrechange()
    {
        return View::make('layouts.centrechange');
    }

    public function centrechanged()
    {
        $user = User::find(Auth::user()->get()->id);
        $city = Input::get('city');
        $user->centre_city = $city*10;
        if(Centre::where('city_id',$city)->where('online','YES')->where('left','>',0)->count() > 0) {
            $centre = Centre::where('city_id', $city)->where('online', 'YES')->where('left', '>', 0)->first();
            $user->centre_id = $centre->id;
        }
        $user->save();
        return View::make('layouts.centrechanged')->with('user',$user);
    }

    public function certi($name)
    {
        try {
            $data = array('name' => Crypt::decrypt($name), 'rank' => 500, 'squad' => 'HAUTS');
        } catch (Exception $e) {
            return View::make('layouts.error404');
        }
//        if($name == 'name1') {
//            $data = array('name' => Auth::user()->get()->name1);
//        }
//        else if($name == 'name2') {
//            $data = array('name' => Auth::user()->get()->name2);
//        }
//        else {
//            return View::make('layouts.error404');
//        }
//        return View::make('technopedia.certi');
        $pdf = PDF::loadView('technopedia.certi',$data);
        return $pdf->download($data['name'].'.pdf');
    }

    public function certificate()
    {
        if(DB::table('results_2015')->where('roll',Auth::user()->get()->roll)->count()) {
            $rank = DB::table('results_2015')->where('roll', Auth::user()->get()->roll)->first()->rank;
        }
        else {
            $rank = 500;
        }
        return View::make('technopedia.certificate')->with('rank',$rank);
    }

    public function certificatedownload($squad,$name)
    {
        try {
            $name = Crypt::decrypt($name);
            $rank = intval(substr($name, -6));
            $name = substr($name,0,-6);
            $data = array('name' => $name, 'rank' => $rank, 'squad' => $squad);
        } catch (Exception $e) {
            return View::make('layouts.error404');
        }
        $pdf = PDF::loadView('technopedia.certi',$data);
        return $pdf->download($data['name'].'.pdf');
    }

    public function checkomr($id = null)
    {
//        return $id==null ? 'yes':'no';
        if($id == null) {
            if(DB::table('results_2015')->where('error',1)->count() > 0) {
                $str = '<table><tr>';
                $i = 0;
                foreach (DB::table('results_2015')->where('error', 1)->get() as $res) {
                    $str .= '<td><a href="' . route('checkomr').'/'.$res->id . '">' . $res->id . '</a></td>';
                    $i = $i + 1;
                    if($i %30 == 29) {
                        $str .= '</tr><tr>';
                    }
                }
                $str .= '</tr></table>';
            }
            else {
                return 'No more errors in database. Contact me. :)';
            }
            return $str;
        }
        $data = DB::table('results_2015')->find($id);
        DB::table('results_2015')->where('id', $id)->update(array('error' => 3));
        if ($data->kv == 1)
            return View::make('layouts.checkomrjuniorkv')->with('data', $data);
        if ($data->kv == 2) {
            return View::make('layouts.checkomrjuniorkv2')->with('data', $data);
        }
        if($data->roll[0] == 'J') {
            return View::make('layouts.checkomrjunior')->with('data', $data);
        }
        else
            return View::make('layouts.checkomrhauts')->with('data',$data);
    }

    public function checkomr2($id = null)
    {
//        return $id==null ? 'yes':'no';
        if($id == null) {
            if(DB::table('results_2015')->where('error',2)->count() > 0) {
                $str = '<table><tr>';
                $i = 0;
                foreach (DB::table('results_2015')->where('error', 2)->get() as $res) {
                    $str .= '<td><a href="' . route('checkomr').'/'.$res->id . '">' . $res->id . '</a></td>';
                    $i = $i + 1;
                    if($i %30 == 29) {
                        $str .= '</tr><tr>';
                    }
                }
                $str .= '</tr></table>';
            }
            else {
                return 'No more errors in database. Contact me. :)';
            }
            return $str;
        }
        $data = DB::table('results_2015')->find($id);
        DB::table('results_2015')->where('id', $id)->update(array('error' => 3));
        if ($data->kv == 1)
            return View::make('layouts.checkomrjuniorkv')->with('data', $data);
        if ($data->kv == 2) {
            return View::make('layouts.checkomrjuniorkv2')->with('data', $data);
        }
        if($data->roll[0] == 'J') {
            return View::make('layouts.checkomrjunior')->with('data', $data);
        }
        else
            return View::make('layouts.checkomrhauts')->with('data',$data);
    }

    public function checkomr3($id = null)
    {
//        return $id==null ? 'yes':'no';
        if($id == null) {
            if(DB::table('results_2015')->where('error',4)->count() > 0) {
                $str = '<table><tr>';
                $i = 0;
                foreach (DB::table('results_2015')->where('error', 4)->get() as $res) {
                    $str .= '<td><a href="' . route('checkomr').'/'.$res->id . '">' . $res->id . '</a></td>';
                    $i = $i + 1;
                    if($i %30 == 29) {
                        $str .= '</tr><tr>';
                    }
                }
                $str .= '</tr></table>';
            }
            else {
                return 'No more errors in database. Contact me. :)';
            }
            return $str;
        }
        $data = DB::table('results_2015')->find($id);
        DB::table('results_2015')->where('id', $id)->update(array('error' => 3));
        if ($data->kv == 1)
            return View::make('layouts.checkomrjuniorkv')->with('data', $data);
        if ($data->kv == 2) {
            return View::make('layouts.checkomrjuniorkv2')->with('data', $data);
        }
        if($data->roll[0] == 'J') {
            return View::make('layouts.checkomrjunior')->with('data', $data);
        }
        else
            return View::make('layouts.checkomrhauts')->with('data',$data);
    }

    public function checkomr4($id = null)
    {
//        return $id==null ? 'yes':'no';
        if($id == null) {
            if(DB::table('results_2015')->where('error',5)->count() > 0) {
                $str = '<table><tr>';
                $i = 0;
                foreach (DB::table('results_2015')->where('error', 5)->get() as $res) {
                    $str .= '<td><a href="' . route('checkomr').'/'.$res->id . '">' . $res->id . '</a></td>';
                    $i = $i + 1;
                    if($i %30 == 29) {
                        $str .= '</tr><tr>';
                    }
                }
                $str .= '</tr></table>';
            }
            else {
                return 'No more errors in database. Contact me. :)';
            }
            return $str;
        }
        $data = DB::table('results_2015')->find($id);
        DB::table('results_2015')->where('id', $id)->update(array('error' => 3));
        if ($data->kv == 1)
            return View::make('layouts.checkomrjuniorkv')->with('data', $data);
        if ($data->kv == 2) {
            return View::make('layouts.checkomrjuniorkv2')->with('data', $data);
        }
        if($data->roll[0] == 'J') {
            return View::make('layouts.checkomrjunior')->with('data', $data);
        }
        else
            return View::make('layouts.checkomrhauts')->with('data',$data);
    }

    public function checkomr5($id = null)
    {
//        return $id==null ? 'yes':'no';
        if($id == null) {
            if(DB::table('results_2015')->where('error',6)->count() > 0) {
                $str = '<table><tr>';
                $i = 0;
                foreach (DB::table('results_2015')->where('error', 6)->get() as $res) {
                    $str .= '<td><a href="' . route('checkomr').'/'.$res->id . '">' . $res->id . '</a></td>';
                    $i = $i + 1;
                    if($i %30 == 29) {
                        $str .= '</tr><tr>';
                    }
                }
                $str .= '</tr></table>';
            }
            else {
                return 'No more errors in database. Contact me. :)';
            }
            return $str;
        }
        $data = DB::table('results_2015')->find($id);
        DB::table('results_2015')->where('id', $id)->update(array('error' => 3));
        if ($data->kv == 1)
            return View::make('layouts.checkomrjuniorkv')->with('data', $data);
        if ($data->kv == 2) {
            return View::make('layouts.checkomrjuniorkv2')->with('data', $data);
        }
        if($data->roll[0] == 'J') {
            return View::make('layouts.checkomrjunior')->with('data', $data);
        }
        else
            return View::make('layouts.checkomrhauts')->with('data',$data);
    }

    public function checkedomr()
    {
        if(Input::has('submit')) {
            $data = DB::table('results_2015')->where('id', Input::get('id'))->update(array('roll' => Input::get('roll'), 'mobile' => Input::get('mobile'), 'q1' => Input::get('q1'), 'q2' => Input::get('q2'), 'q3' => Input::get('q3'), 'q4' => Input::get('q4'), 'q5' => Input::get('q5'), 'q6' => Input::get('q6'), 'q7' => Input::get('q7'), 'q8' => Input::get('q8'), 'q9' => Input::get('q9'), 'q10' => Input::get('q10'), 'q11' => Input::get('q11'), 'q12' => Input::get('q12'), 'q13' => Input::get('q13'), 'q14' => Input::get('q14'), 'q15' => Input::get('q15'), 'q16' => Input::get('q16'), 'q17' => Input::get('q17'), 'q18' => Input::get('q18'), 'q19' => Input::get('q19'), 'q20' => Input::get('q20'), 'q21' => Input::get('q21'), 'q22' => Input::get('q22'), 'q23' => Input::get('q23'), 'q24' => Input::get('q24'), 'conf1' => Input::get('conf1'), 'conf2' => Input::get('conf2'), 'error' => 0));
        }
        else {
            if(Input::get('error') == 'Error') {
                $error = 2;
            }
            elseif (Input::get('error') == 'Not Scanned') {
                $error = 4;
            }
            elseif (Input::get('error') == 'No School') {
                $error = 5;
            }
            else {
                $error = 6;
            }
            $data = DB::table('results_2015')->where('id', Input::get('id'))->update(array('roll' => Input::get('roll'), 'mobile' => Input::get('mobile'), 'q1' => Input::get('q1'), 'q2' => Input::get('q2'), 'q3' => Input::get('q3'), 'q4' => Input::get('q4'), 'q5' => Input::get('q5'), 'q6' => Input::get('q6'), 'q7' => Input::get('q7'), 'q8' => Input::get('q8'), 'q9' => Input::get('q9'), 'q10' => Input::get('q10'), 'q11' => Input::get('q11'), 'q12' => Input::get('q12'), 'q13' => Input::get('q13'), 'q14' => Input::get('q14'), 'q15' => Input::get('q15'), 'q16' => Input::get('q16'), 'q17' => Input::get('q17'), 'q18' => Input::get('q18'), 'q19' => Input::get('q19'), 'q20' => Input::get('q20'), 'q21' => Input::get('q21'), 'q22' => Input::get('q22'), 'q23' => Input::get('q23'), 'q24' => Input::get('q24'), 'conf1' => Input::get('conf1'), 'conf2' => Input::get('conf2'), 'error' => $error));
        }
        return Redirect::route('checkomr');
    }

    public function omrtest()
    {
        $data = DB::table('results_2015')->find(24960);
        return View::make('layouts.checkomrjuniorkv2')->with('data',$data);
    }

    public function resultlogin()
    {
        return View::make('technopedia.resultlogin');
    }

    public function postresultlogin()
    {
        $roll = Input::get('roll');
        $password = Input::get('password');
        $user = array(
            'roll' => $roll,
            'password' => $password
        );

        if(Auth::user()->attempt($user)) {
            return Redirect::intended('/');
        }
        else {
            if(User::where('roll',$roll)->count()) {
                $user = User::where('roll',$roll)->first();
//                return Crypt::decrypt($user->result_pass).'<br>'.$password;
                if(Crypt::decrypt($user->result_pass) == $password) {
                    Auth::user()->login($user);
                    return Redirect::intended('/');
                }
                return Redirect::route('technopedialogin')->with('error', 'Incorrect Password')->withInput();
            }
        }
        return Redirect::route('technopedialogin')->with('error', 'Incorrect combination of roll number and password')->withInput();
    }

    public function results()
    {
        return Redirect::route('result');
    }

    public function result()
    {
        if(Auth::user()->get()->confDetails == 0) {
            return Redirect::route('confdetails');
        }
        $user = User::find(1);
        return View::make('technopedia.result')->with('user',$user);
    }

    public function confirmDetails()
    {
        return View::make('technopedia.confirmDetails');
    }

    public function postconfirmDetails()
    {
        $user = Auth::user()->get();
        Auth::user()->get()->name1 = Input::get('name1');
        Auth::user()->get()->name2 = Input::get('name2');
        Auth::user()->get()->confDetails = 1;
        Auth::user()->get()->save();
        return Redirect::route('result');
    }
}
