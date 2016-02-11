<?php

class AdminController extends \BaseController {

	public function login()
    {
        if(Auth::admin()->check())
        {
            return Redirect::route('adminprofile');
        }
        return View::make('admin.login');
    }

    public function postlogin()
    {
        $admin= array(
            'username' => Input::get('username'),
            'password' => Input::get('password')
        );

        if(Auth::admin()->attempt($admin, Input::get('remember')==='yes')) {
            return Redirect::intended('toor/profile');
        }
        return Redirect::route('adminlogin')->with('error','Incorrect Credentials');

    }

    public function logout()
    {
        Auth::admin()->logout();
        return Redirect::route('adminlogin');
    }

    public function forgot() {
        return View::make('admin.forgot');
    }

    public function postforgot()
    {
        $email=Input::get('email');
        $admin=DB::table('admins')->where('email',$email)->first();
        if($admin == null) {
            return Redirect::route('adminforgot')->with('error','Email ID does not exist.');
        }
        else {
            $pass=str_random(6);
            DB::table('admins')->where('email',$email)->update(array('password' => Hash::make($pass)));
            Mail::send('emails.adminforgot', array('admin' => $admin,'password' => $pass) , function($message) use ($admin) {
                $message->to($admin->email, $admin->name)->subject('CityRep Password Reset');
            });
        }
        return Redirect::route('adminlogin')->with('error','Check your mail');
    }

    public function profile()
    {
        return View::make('admin.profile');
    }

    public function editprofile()
    {
        $name=Input::get('name');
        $email=Input::get('email');
        $contact=Input::get('contact');
        $webmail=Input::get('webmail');
        $gender=Input::get('gender');
        $username=Input::get('username');
        $technomail=Input::get('technomail');
        $region=Input::get('region');
        $gender=Input::get('gender');

        if(DB::table('admins')->where('username',$username)->where('id','!=',Auth::admin()->get()->id)->count()) {
            $error='Another Admin exists with the given username.';
            return Redirect::route('crepprofile')->with('error',$error);
        }
        DB::table('admins')->where('id',Auth::admin()->get()->id)->update(array('name' => $name, 'username' => $username, 'contact' => $contact, 'email' => $email, 'techno_email' => $technomail, 'region' => $region, 'gender' => $gender));
        return Redirect::route('adminprofile');
    }

    public function chpass()
    {
        $oldpass=Input::get('oldpass');
        $newpass=Input::get('newpass');
        $cnfpass=Input::get('cnfnewpass');
        $pass=Auth::admin()->get()->password;
        if($newpass === $cnfpass) {
            if(Hash::check($oldpass, $pass)) {
                DB::table('admins')->where('id',Auth::admin()->get()->id)->update(array('password' => Hash::make($newpass)));
                return 'Password Updated';
            }
            else {
                return 'Old Password is incorrect.';
            }
        }
        return 'New Password and Confirm Password donot match';
    }

    public function regs()
    {
        return View::make('admin.registrations');
    }

    public function postregs()
    {
        $city_id=intval(Input::get('city'));
        $city_code=strval(City::find($city_id)->code);
        $schools=User::where('city_id',$city_id)->where('paid',1)->select('school_id')->groupBy('school_id')->get();
//        return $schools;
        return View::make('admin.registrations', array('schools' => $schools, 'code' => $city_code,'city' => $city_id));
    }

    public function deleteregs()
    {
        $id=intval(Input::get('id'));
        $user=User::find($id);
        $user->delete();
        return 'success';
    }

    public function editregs()
    {
        $id=intval(Input::get('id'));
        $user=User::find($id);
        $user->name1=Input::get('name1');
        $user->name2=Input::get('name2');
        $user->email1=Input::get('email1');
        $user->email2=Input::get('email2');
        $user->contact1=intval(Input::get('contact1'));
        $user->contact2=intval(Input::get('contact2'));
        $user->save();
        return 'success';
    }

    public function generatepasswords()
    {
        return View::make('admin.generatepass');
    }

    public function generatedpasswords()
    {
        $school=School::find(intval(Input::get('school')));
        $text='';
        foreach(User::where('school_id',intval(Input::get('school')))->where('paid',1)->get() as $user)
        {
            $password=str_random(6);
            $hash=Hash::make($password);
            $user->password=$hash;
            $user->save();
            $text .= '<tr><td>'.$user->name1.'</td><td>'.$user->name2.'</td><td>'.$user->roll.'</td><td> '.$password.'</td></tr>';
        }
        return View::make('admin.generatedpass')->with('body',$text)->with('school',$school);
    }

    public function uploadreg()
    {
        return View::make('admin.uploadreg');
    }

    public function postuploadreg()
    {
        $error = '';
        $rules= array(
            'name1'     => 'required',
            'name2'     => 'required',
            'email1'    => 'email',
            'email2'    => 'email',
            'contact1'  => 'numeric',
            'contact2'  => 'numeric',
            'language'  => 'required|in:en,hi',
            'squad'     => 'required|in:JUNIOR,HAUTS'
        );
        $ext=Input::file('reg')->getClientOriginalExtension();
        if($ext !== 'csv') {
            return View::make('admin.uploadreg')->with('error','File extension is not <b>csv</b>');
        }
        $filename=date('His-dm',time()).Auth::admin()->get()->name.Input::get('city').'-'.Input::get('school').'.csv';
        Input::file('reg')->move('regs/uploads/',$filename);
        $result = Excel::load('regs/uploads/'.$filename)->get();
        if (count($result[0]) == 8) {
            $data = $result[0]->toArray();
            if (array_key_exists('name1',$data) && array_key_exists('name2', $data) && array_key_exists('email1', $data) && array_key_exists('email2', $data) && array_key_exists('contact1', $data) && array_key_exists('contact2', $data) && array_key_exists('squad', $data) && array_key_exists('language', $data)) {
                foreach ($result as $reg) {
                    $data=$reg->toArray();
                    $v = Validator::make($data, $rules);
                    if ($v->fails()) {
                        $fail = $v->failed();
                        $error .= '<tr>
                            <td class="' . (array_key_exists('name1', $fail) ? 'danger' : '') . '">' . $reg->name1 . '</td>
                            <td class="' . (array_key_exists('name2', $fail) ? 'danger' : '') . '">' . $reg->name2 . '</td>
                            <td class="' . (array_key_exists('email1', $fail) ? 'danger' : '') . '">' . $reg->email1 . '</td>
                            <td class="' . (array_key_exists('email2', $fail) ? 'danger' : '') . '">' . $reg->email2 . '</td>
                            <td class="' . (array_key_exists('contact1', $fail) ? 'danger' : '') . '">' . $reg->contact1 . '</td>
                            <td class="' . (array_key_exists('contact2', $fail) ? 'danger' : '') . '">' . $reg->contact2 . '</td>
                            <td class="' . (array_key_exists('language', $fail) ? 'danger' : '') . '">' . $reg->language . '</td>
                            <td class="' . (array_key_exists('squad', $fail) ? 'danger' : '') . '">' . $reg->squad . '</td>
                            </tr>';
                    }
                }
                if (!strlen($error)) {
                    return Redirect::route('adminuploadedreg')->with('file', $filename)->with('school', Input::get('school'))->with('city',Input::get('city'))->with('kv',Input::get('kv'));
                } else {
                    return View::make('admin.uploadreg')->with('reg_errors', $error);
                }
            }
            else {
                return View::make('admin.uploadreg')->with('error','Heading of columns are incorrect.Refer the sample file provided');
            }
        }
        else {
            return View::make('admin.uploadreg')->with('error','Number of columns is incorrect.');
        }
    }

    public function uploadedreg()
    {
        $details = '';
        if (Session::has('file')) {
            $file = Session::get('file');
            $city = City::find(Session::get('city'));
            $result = Excel::load('regs/uploads/' . $file)->get();
            $kv = Session::get('kv')=='yes';
            foreach ($result as $reg) {
                $user = new User;
                $user->name1        = strtoupper($reg->name1);
                $user->name2        = strtoupper($reg->name2);
                $user->email1       = $reg->email1;
                $user->email2       = $reg->email2;
                $user->contact1     = $reg->contact1;
                $user->contact2     = $reg->contact2;
                $user->squad        = $reg->squad;
                $user->language     = $reg->language;
                $user->city_id      = $city->id;
                $user->centre_city  = ($city->id)*10;
                $user->school_id    = Session::get('school');
                $roll = ($user->squad == 'HAUTS') ? 'H' : 'J';
                $roll .= ($user->language == 'en') ? 'E' : 'H';
                $roll .= strval($city->code);
                $roll .=  $kv ? '2' : '0';
                $lastroll = User::withTrashed()->where('roll', 'LIKE', "%$roll%")->count();
                $roll .= str_pad(strval($lastroll + 1), 4, "0", STR_PAD_LEFT);
                $user->roll = $roll;
                $user->year = 2015;
                $pass = str_random(6);
                $user->password = Hash::make($pass);
                $user->paid = $kv ? 2 : 1;
                $user->status = $kv ? 2 : 0;
                if($kv) { $user->result_pass = Crypt::encrypt($pass); }
                $user->comments = 'Added by ' . Auth::admin()->get()->name . ' on ' . date('H:i:s d-m-Y', time());
                $user->save();
                $details .= '<tr>
                                <td>' . $user->name1 . '</td>
                                <td>' . $user->name2 . '</td>
                                <td>' . $user->roll . '</td>
                                <td>' . $pass . '</td>
                            </tr>';
            }
            if($kv) {
                File::move(public_path() . '/regs/uploads/' . $file, public_path() . '/regs/kvuploads/' . $file);
            }
            else {
                File::move(public_path() . '/regs/uploads/' . $file, public_path() . '/regs/adminuploads/' . $file);
            }
            return View::make('admin.uploadedreg')->with('details', $details);
        } else {
            return Redirect::route('adminuploadreg');
        }
    }

    public function mailjnvs()
    {
        foreach(DB::table('jnvs')->whereBetween('id',array(1,100))->get() as $school) {
            Mail::send('emails.jnv', array('name' => '') ,function($message) use ($school)
            {
                $message->from('technothlon@techniche.org', 'Aneesh Dash');
                $message->to($school->email)->subject('Technothlon');
                $message->attach('mail_attach/Brochure.pdf', array('as' => "Brochure, Technothlon'15", 'mime' => 'application/pdf'));
                $message->attach('mail_attach/registration_sheet.xlsx', array('as' => "Registration Sheet, Technothlon'15", 'mime' => 'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet'));
            });
        }
        return View::make('layouts.home');
    }

    public function mailonlinekv()
    {
        $schools = '';
        $sum = 0;
        foreach(School::where('name','LIKE','%kendriya%')->where('verified',0)->get() as $school)
        {
            $count = User::where('school_id',$school->id)->count();
            if($count > 0) {
                $schools .= $school->name.' '.$school->id.' '.$count.'<br>';
                Mail::send('emails.onlinekv', array('count' => $count) ,function($message) use ($school)
                {
                    $message->from('technothlon@techniche.org', 'Technothlon');
                    $message->to($school->email)->subject('Technothlon Registration');
                    $message->attach('mail_attach/KV_Circular.PDF', array('as' => "KV Circular, Technothlon'15", 'mime' => 'application/pdf'));
                    $message->attach('mail_attach/registration_sheet.xlsx', array('as' => "Registration Sheet, Technothlon'15", 'mime' => 'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet'));
                });
            }
        }
        return $sum.'<br>'.$schools;
    }

    public function kvfilegenerate()
    {
        foreach(School::whereVerified(4)->get() as $school) {
            Excel::create($school->id, function ($excel) use ($school) {
                $excel->setTitle('Results');
                $excel->setCreator('Technothlon')
                    ->setCompany('Technothlon');
                $excel->setDescription('Results');

                $excel->sheet('Result', function ($sheet) use ($school) {
                    $sheet->appendRow(array('Name 1', 'Name 2', 'Roll', 'Squad','KV/JNV Rank'));
                    $users = array();
                    foreach (User::where('school_id', $school->id)->orderBy('squad')->get() as $user) {
                        $res = DB::table('results_2015')->where('roll',$user->roll)->first();
                        if($res) {
                            $users[] = array($user->name1, $user->name2, $user->roll, $user->squad,$res->rank);
                        }
                    }
                    $sheet->rows($users);
                });

            })->store('xlsx', storage_path('files/kvresult'));
        }
        //Generate file for roll number and password
//        foreach(School::whereVerified(2)->get() as $school) {
//            Excel::create($school->id, function ($excel) use ($school) {
//                $excel->setTitle('KV Registrations');
//                $excel->setCreator('Technothlon')
//                    ->setCompany('Technothlon');
//                $excel->setDescription('Registration details for Kendriya Vidyalaya');
//
//                $excel->sheet('JUNIOR', function ($sheet) use ($school) {
//                    $sheet->appendRow(array('Name 1', 'Name 2', 'Roll', 'Password'));
//                    $users = array();
//                    foreach (User::where('school_id', $school->id)->wherePaid(2)->whereSquad('JUNIOR')->get() as $user) {
//                        $users[] = array($user->name1, $user->name2, $user->roll, Crypt::decrypt($user->result_pass));
//                    }
//                    $sheet->rows($users);
//                });
//
//                $excel->sheet('HAUTS', function ($sheet) use ($school) {
//                    $sheet->appendRow(array('Name 1', 'Name 2', 'Roll', 'Password'));
//                    $users = array();
//                    foreach (User::where('school_id', $school->id)->wherePaid(2)->whereSquad('HAUTS')->get() as $user) {
//                        $users[] = array($user->name1, $user->name2, $user->roll, Crypt::decrypt($user->result_pass));
//                    }
//                    $sheet->rows($users);
//                });
//
//            })->store('xlsx', storage_path('files/kv'));
//        }
    }

    public function kvrollmail()
    {
        foreach(School::where('verified',6)->get() as $school)
        {
            Mail::send('emails.kvresult', array() ,function($message) use ($school)
            {
                $message->from('technothlon@techniche.org', 'Technothlon');
                $message->to($school->email)->subject('Technothlon Prelims Result');
                $message->attach('../app/storage/files/kvresults'.$school->id.'.xlsx', array('as' => "Technothlon'15 Prelims Result", 'mime' => 'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet'));
            });
            $school->verified = 7;
            $school->save();
        }
    }

    public function centrechange()
    {
        $emails = '';
        foreach(City::where('online',1)->get() as $city)
        {
            CityRep::where('city_id',$city->id)->delete();
            foreach(User::where('city_id',$city->id)->get() as $user)
            {
                $emails .= $user->email1.';'.$user->email2.';';
            }
        }
        return $emails;
    }

    public function onlineadmit()
    {
        foreach(User::whereBetween('id',array(1,100))->where('paid',0)->get() as $user)
        {
            if($user->email1 != null) {
                Queue::push(function ($job) use ($user) {
                    Mail::send('emails.offline', array('user' => $user), function ($message) use ($user) {
                        $message->to($user->email1, $user->name1)->subject('Technothlon Admit Card');
                    });
                    $job->delete;
                });
            }
            if($user->email2 != null) {
                Queue::push(function ($job) use ($user) {
                    Mail::send('emails.offline', array('user' => $user), function ($message) use ($user) {
                        $message->to($user->email2, $user->name2)->subject('Technothlon Admit Card');
                    });
                    $job->delete;
                });
            }
        }
    }

    public function download($file = null)
    {
        if($file == null) {
            return View::make('admin.download');
        }
        return Response::download(storage_path().'/files/download/'.$file.'.pdf');
    }

    public function checkresult()
    {
//        $roll = '';
        foreach(DB::table('results_2015')->where('checkdetails',0)->get() as $res)
        {
            if(strlen($res->roll) == 10 && User::whereRoll($res->roll)->count() == 0) {
                $user = new User;
                $user->name1        = 'User 1';
                $user->name2        = 'User 2';
                $user->contact1     = $res->mobile;
                $pass = str_random(6);
                $user->password     = Hash::make($pass);
                $user->result_pass  = Crypt::encrypt($pass);
                $user->roll         = $res->roll;
                $user->year         = 2015;
                $user->status       = 5;
                $user->comments     = 'Added from results_2015';
                if($user->roll[0] == 'J') {
                    $user->squad    = 'JUNIOR';
                }
                else {
                    $user->squad    = 'HAUTS';
                }
                if($user->roll[1] == 'E') {
                    $user->language = 'en';
                }
                else {
                    $user->language = 'hi';
                }
                $user->save();
                DB::table('results_2015')->where('roll',$res->roll)->update(array('checkdetails'=>1));
//                $roll .= $res->roll.'<br>';
            }
        }
    }

    public function uploadres()
    {
        return View::make('admin.uploadres');
    }

    public function postuploadres()
    {
        $details = '';
        $ext=Input::file('reg')->getClientOriginalExtension();
        if($ext !== 'csv') {
            return View::make('admin.uploadreg')->with('error','File extension is not <b>csv</b>');
        }
        $filename=date('His-dm',time()).Auth::admin()->get()->name.'.csv';
        Input::file('reg')->move(storage_path().'/files/result/uploads/',$filename);
        $result = Excel::load(storage_path().'/files/result/uploads/' . $filename)->get();
        foreach ($result as $res) {
            $sqd = $res->roll[0];
            $rank = DB::table('results_2015')->where('roll','LIKE',"%$sqd%")->where('kv',0)->where('score','>=',$res->score)->orderBy('score')->first()->rank;
            DB::table('results_2015')->insert(array('roll'=>$res->roll,'mobile'=>$res->mobile,'filename'=>$res->filename,'path'=>$res->path,'rank'=>$rank,'kv'=>$res->kv,'q1'=>$res->q1,'q2'=>$res->q2,'q3'=>$res->q3,'q4'=>$res->q4,'q5'=>$res->q5,'q6'=>$res->q6,'q7'=>$res->q7,'q8'=>$res->q8,'q9'=>$res->q9,'q10'=>$res->q10,'q11'=>$res->q11,'q12'=>$res->q12,'q13'=>$res->q13,'q14'=>$res->q14,'q15'=>$res->q15,'q16'=>$res->q16,'q17'=>$res->q17,'q18'=>$res->q18,'q19'=>$res->q19,'q20'=>$res->q20,'q21'=>$res->q21,'q22'=>$res->q22,'q23'=>$res->q23,'q24'=>$res->q24,'conf1'=>$res->conf1,'conf2'=>$res->conf2));
            $details .= '<tr><td>'.$res->roll.'</td><td>'.$rank.'</td></tr>';
        }
        return View::make('admin.uploadedres')->with('details', $details);
    }

    public function kvregs()
    {
//        return School::where('verified',3)->first();
        return View::make('admin.kvregistrations');
    }

    public function certi()
    {
        return PDF::loadView('admin.certi')->stream('certi.pdf');
    }

    public function adminscore() {
        return View::make('fsd.adminscore');
    }

    public function updatescore() {
        $team1 = Input::get('team1');
        $team2 = Input::get('team2');
        $team3 = Input::get('team3');
        $team4 = Input::get('team4');
        $team5 = Input::get('team5');
        DB::table('fsdjun')->where('team','team1')->update(array('score'=>$team1));
        DB::table('fsdjun')->where('team','team2')->update(array('score'=>$team2));
        DB::table('fsdjun')->where('team','team3')->update(array('score'=>$team3));
        DB::table('fsdjun')->where('team','team4')->update(array('score'=>$team4));
        DB::table('fsdjun')->where('team','team5')->update(array('score'=>$team5));
        return 'done';
//        return Redirect::route('adminscore')->withInput();
    }

    public function hautsadminscore() {
        return View::make('fsd.hautsadminscore');
    }

    public function hautsupdatescore() {
        $winner = Input::get('winner');
        $loser = Input::get('loser');
        $timeval = Input::get('timeval');
        $time = Input::get('time');
        $winnert = 'team'.$winner;
        $losert = 'team'.$loser;
        $team = 'team'.Input::get('team');
        $rw = DB::table('fsdjun')->where('team',$winnert)->first()->score;
        $rw = DB::table('fsdjun')->where('score','>',$rw)->count();
        $rl = DB::table('fsdjun')->where('team',$losert)->first()->score;
        $rl = DB::table('fsdjun')->where('score','>',$rl)->count();
        $score = 60/(1+(($rl-$rw)/12));
//        return $score;
        if($time == 'true') {
//            return 1;
            $score /= 2;
            $score += (120-$timeval)/120;
            $newscore = DB::table('fsdjun')->where('team',$team)->first()->score + 30;
            DB::table('fsdjun')->where('team',$team)->update(array('score'=>$newscore));
        }
        $newscore = DB::table('fsdjun')->where('team',$winnert)->first()->score + $score;
        DB::table('fsdjun')->where('team',$winnert)->update(array('score'=>$newscore));
        return $score;
//        return Redirect::route('adminscore')->withInput();
    }

    public function score() {
        $table='
    <table class="rwd-table">
        <tr>
            <th>Rank</th>
            <th>Name 1</th>
            <th>Name 2</th>
            <th>Team Number</th>
            <th>Score</th>
        </tr>';
            $scores=DB::table('fsdjun')->orderBy('score','desc')->get();
            $users =array('team1'=>array('name1'=>'Tarun','name2'=>'Anubhav'),'team2'=>array('name1'=>'Guhan','name2'=>'Gaurang'), 'team3'=>array('name1'=>'Vatsal','name2'=>'Rahul'), 'team4'=>array('name1'=>'Nikhil','name2'=>'Yash'), 'team5'=>array('name1'=>'Milind','name2'=>'Naman'));
//        return $users[$scores[0]->team]['name1'];
            for($rank=0;$rank<5;$rank++)
            {
                $score = $scores[$rank];
                $name1 = $users[$score->team]['name1'];
                $name2 = $users[$score->team]['name2'];
                $table .= ' <tr>
            <td>'.($rank+1).'</td>
            <td>'.$name1.'</td>
            <td>'.$name2.'</td>
            <td>'.($scores[$rank]->id - 1).'</td>
            <td>'.$scores[$rank]->score.'</td>
        </tr>';
//                $table .= $users[$rank]->roll.'<br>';
            }
            $table .= ' </table><br><br>';
        return View::make('fsd.score')->with('table',$table);
    }

    public function scoreupdate()
    {
        $table = '
        <tr>
            <th>Rank</th>
            <th>Name 1</th>
            <th>Name 2</th>
            <th>Team Number</th>
            <th>Score</th>
        </tr>';
        $scores = DB::table('fsdjun')->orderBy('score', 'desc')->get();
        $users =array('team1'=>array('name1'=>'Tarun','name2'=>'Anubhav'),'team2'=>array('name1'=>'Guhan','name2'=>'Gaurang'), 'team3'=>array('name1'=>'Vatsal','name2'=>'Rahul'), 'team4'=>array('name1'=>'Nikhil','name2'=>'Yash'), 'team5'=>array('name1'=>'Milind','name2'=>'Naman'));
//        return $users[$scores[0]->team]['name1'];
        for ($rank = 0; $rank < 5; $rank++) {
            $score = $scores[$rank];
            $name1 = $users[$score->team]['name1'];
            $name2 = $users[$score->team]['name2'];
            $table .= ' <tr>
            <td>' . ($rank + 1) . '</td>
            <td>' . $name1 . '</td>
            <td>' . $name2 . '</td>
            <td>'.($scores[$rank]->id - 1).'</td>
            <td>' . $scores[$rank]->score . '</td>
        </tr>';
        }
        return $table;
    }

    public function test()
    {
        $output = '<table>';
        foreach(Centre::all() as $centre)
        {
            $output .= '<tr><td>'.$centre->name.'</td><td>'.$centre->address.'</td><td>'.$centre->city->name.'</td><td>'.$centre->city->state->name.'</td><td>'.$centre->pincode.'</td></tr>';
        }
        $output .= '</table>';
        return $output;
        return PDF::loadView('admin.certi')->stream('certi_final.pdf');
//        return View::make('admin.centrecerti');
//        $pdf = PDF::loadView('admin.centrecerti');
//        return $pdf->stream('certi.pdf');
        $out='<table>';
        $out .= '<tr><td>Name</td><td>Address</td><td>City</td><td>Pincode</td></tr>';
        $count = 0;
        foreach(Centre::orderBy('city_id')->get() as $centre)
        {
           $out .= '<tr><td>'.$centre->name.'</td><td>'.$centre->address.'</td><td>'.$centre->city->name.'</td><td>'.$centre->pincode.'</td></tr>';
        }
//        foreach (DB::table('results_2015')->where('rank','<','51')->where('kv',1)->get() as $user)
//        {
//            if(User::where('roll',$user->roll)->count()) {
//                $users = User::where('roll',$user->roll)->first();
//                if($users->status == 3 || $users->status == 5) {
////                    dd($users);
//                    $out .= '<tr><td>'.$user->rank.'</td><td>'.$user->roll.'</td><td>'.$user->mobile.'</td><td>'.$users->name1.'</td><td>'.$users->name2.'</td><td>'.$user->path.'</td><td></td><td></td><td></td><td></td><td></td><td></td><td>'.$users->squad.'</td></tr>';
//                }
//                else {
//                    try {
//                        $out .= '<tr><td>'.$user->rank.'</td><td>'.$user->roll.'</td><td>'.$user->mobile.'</td><td>'.$users->name1.'</td><td>'.$users->name2.'</td><td>'.$users->school->name.'</td><td>'.$users->city->name.'</td><td>'.$users->school->address.'</td><td>'.$users->school->pincode.'</td><td>'.$users->school->contact.'</td><td>'.$users->contact1.'</td><td>'.$users->contact2.'</td><td>'.$users->squad.'</td></tr>';
//                    }catch (Exception $e) {
//                        return var_dump($users);
//                    }
//                }
////                $count++;
//            }
//        }
//        return $count;
        return $out.'</table>';
        $pdf = PDF::loadView('admin.certi');
        return $pdf->stream('certi.pdf');
        $det = '<table>';
        foreach(City::orderBy('state_id')->get() as $city)
        {
            $count = User::whereCityId($city->id)->count();
            if($count) {
                $det .= '<tr><td>'.$city->name.'</td><td>'.$city->state->name.'</td><td>'.$count.'</td></tr>';
            }
        }
        $det .= '</table>';
        return $det;
//        $list = '<table>';
//        foreach(DB::table('results_2015')->where('rank','<','27')->where('kv','!=',1)->where('roll','LIKE',"H%")->get() as $res)
//        {
//            $user = User::whereRoll($res->roll)->first();
//            if(!$user) {
//                $name1 = 'User1';
//                $name2 = 'User2';
//            }
//            else {
//                $name1 = $user->name1;
//                $name2 = $user->name2;
//            }
//            $list .= '<tr><td>'.$res->rank.'</td><td>'.$res->roll.'</td><td>'.$name1.'</td><td>'.$name2.'</td><td>'.$res->mobile.'</td><td>'.$res->path.'</td></tr>';
//        }
//        $list .= '</table>';
//        return $list;
//        $rolls = array('HE53600040','HE53600004','HE53600027','HE53600022','HE53600023','HE53600002','HE53600005','HE53600003','HE53600006','HE53600034','HE53600033','HE53600037','HE53600001','HE53600039','HE53600038','HE53600018','HE53600011','HE53600010','HE53600009','HE53600008','HE53600007','HE53600025','HE53600026','HE53600020','HE53600019','HE53600016','HE53600017','HE53600015','HE53600014','HE53600013','HE53600012');
//        $list = '';
//        foreach($rolls as $roll)
//        {
//            $old = User::whereRoll($roll)->first();
//            $user = $old->replicate();
//            $user->squad = 'JUNIOR';
//            $lastroll = User::withTrashed()->where('roll', 'LIKE', "%JE5360%")->count();
//            $roll = 'JE5360'.str_pad(strval($lastroll + 1), 4, "0", STR_PAD_LEFT);
//            $user->roll = $roll;
//            $user->comments = 'Change squad';
//            $user->push();
//            $list .= $old->roll.'  '.$user->roll.'<br>';
//        }
//        return $list;
        $user = User::whereRoll('HE52530018')->first();
        return $user->roll.'<br>'.Crypt::decrypt($user->result_pass).'<br>'.$user->name1.'<br>'.$user->name2;
        foreach(User::where('city_id',21)->where('paid',1)->get() as $user)
        {
            $password = str_random(6);
            $school = $user->school;
            $user->password = Hash::make($password);
            $user->save();
            if($user->email1 !== "") {
                Queue::push(function($job) use ($user, $password, $school) {
                    Mail::send('emails.offline', array('user' => $user, 'school' => $school, 'password' => $password, 'name' => $user->name1) , function($message) use ($user) {
                        $message->to($user->email1, $user->name1)->subject('Technothlon Registration Details');
                    });
                    $job->delete;
                });
            }
            if($user->email1 !== "") {
                Queue::push(function($job) use ($user, $password, $school) {
                    Mail::send('emails.offline', array('user' => $user, 'school' => $school, 'password' => $password, 'name' => $user->name2) , function($message) use ($user) {
                        $message->to($user->email2, $user->name2)->subject('Technothlon Registration Details');
                    });
                    $job->delete;
                });
            }
        }
        return View::make('emails.kvroll');
        return $pdf = PDF::loadView('technopedia.onlineadmitcard')->stream('admit-cards/users/'.Auth::user()->get()->roll.'.pdf');
        return View::make('technopedia.onlineadmitcard');
        $schools = '';
        foreach(Centre::all() as $centre)
        {
            $count = User::where('centre_id',$centre->id)->count();
            $schools .= $count.' '.($centre->strength-$centre->left).' '.$centre->id;
        }
        return $schools;
        foreach(School::where('verified',2)->get() as $school)
        {
            $junior = User::where('school_id',$school->id)->where('squad','JUNIOR')->count();
            $hauts = User::where('school_id',$school->id)->where('squad','HAUTS')->count();
            $schools .= $school->name.'<br>'.$school->address.'<br>'.$school->city->name.' Pin: '.$school->pincode.'<br>'.$school->city->state->name.'<br>Ph.: '.$school->contact.'<br>Junior:'.$junior.' Hauts: '.$hauts.'<br><br>';
        }
        return $schools;
//        return View::make('admin.test');
    }
}
