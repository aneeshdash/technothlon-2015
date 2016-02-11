<?php

class CRepController extends \BaseController {

    public function login()
    {
        if(Auth::crep()->check())
        {
            return Redirect::route('crepregs');
        }
        return View::make('crep.login');
    }

    public function postlogin()
    {
//        $rules = array(
//            'g-recaptcha-response' => 'required|recaptcha'
//        );
//        $validator = Validator::make(Input::all(), $rules);
//        if ($validator->fails())
//        {
//            Input::flash();
//            return Redirect::route('creplogin')->withErrors($validator)->withInput();
//        }
        $crep= array(
            'email' => Input::get('email'),
            'password' => Input::get('password')
        );

        if(Auth::crep()->attempt($crep, Input::get('remember')==='yes')) {
            return Redirect::intended('cityrep/registrations');
        }
        return Redirect::route('creplogin')->with('error','Incorrect Credentials');

    }

    public function logout()
    {
        Auth::crep()->logout();
        return Redirect::route('creplogin');
    }

    public function forgot() {
        return View::make('crep.forgot');
    }

    public function postforgot()
    {
        $email=Input::get('email');
        $crep=CityRep::where('email',$email)->first();
        if($crep == null) {
            return Redirect::route('crepforgot')->with('error','Email ID does not exist.');
        }
        else {
            $pass=str_random(6);
            $crep->password=Hash::make($pass);
            $crep->save();
//            Queue::push(function($job) use ($crep, $pass) {
                Mail::send('emails.crepforgot', array('crep' => $crep,'password' => $pass) , function($message) use ($crep) {
                    $message->to($crep->email, $crep->name)->subject('CityRep Password Reset');
//                });
//                $job->delete;
            });
        }
        return Redirect::route('creplogin')->with('error','Check your mail');
    }

    public function profile()
    {
        return View::make('crep.profile');
    }

    public function editprofile()
    {
        $name=Input::get('name');
        $email=Input::get('email');
        $contact=Input::get('contact');
        $webmail=Input::get('webmail');
        $gender=Input::get('gender');
        if(CityRep::where('email',$email)->where('id','!=',Auth::crep()->get()->id)->count()) {
            $error='Another Ciryrep exists with the given email id.';
            return Redirect::route('crepprofile')->with('error',$error);
        }
        $crep=CityRep::find(Auth::crep()->get()->id);
        $crep->name=$name;
        $crep->email=$email;
        $crep->contact_home=$contact;
        $crep->webmail=$webmail;
        $crep->gender=$gender;
        $crep->save();
//        return Input::get('contact');
        return Redirect::route('crepprofile');
    }

    public function chpass()
    {
        $oldpass=Input::get('oldpass');
        $newpass=Input::get('newpass');
        $cnfpass=Input::get('cnfnewpass');
        $pass=Auth::crep()->get()->password;
        if($newpass === $cnfpass) {
            if(Hash::check($oldpass, $pass)) {
                $crep=CityRep::find(Auth::crep()->get()->id);
                $crep->password=Hash::make($newpass);
                $crep->save();
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
        $city_id=Auth::crep()->get()->city->id;
        $city_code=strval(Auth::crep()->get()->city->code);
        $schools=User::where('city_id',$city_id)->where('paid',1)->select('school_id')->groupBy('school_id')->get();
        return View::make('crep.registrations', array('schools' => $schools, 'code' => $city_code));
    }

    public function uploadreg()
    {
        return View::make('crep.uploadreg');
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
            return View::make('crep.uploadreg')->with('error','File extension is not <b>csv</b>');
        }
        $filename=date('His-dm',time()).Auth::crep()->get()->name.Auth::crep()->get()->id.'-'.Input::get('school').'.csv';
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
                    return Redirect::route('crepuploadedreg')->with('file', $filename)->with('school', Input::get('school'));
                } else {
                    return View::make('crep.uploadreg')->with('reg_errors', $error);
                }
            }
            else {
                return View::make('crep.uploadreg')->with('error','Heading of columns are incorrect.Refer the sample file provided');
            }
        }
        else {
            return View::make('crep.uploadreg')->with('error','Number of columns is incorrect.');
        }
    }

    public function uploadedreg()
    {
        $details = '';
        if (Session::has('file')) {
            $file = Session::get('file');
            $result = Excel::load('regs/uploads/' . $file)->get();
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
                $user->city_id      = Auth::crep()->get()->city_id;
                $user->centre_id      = Auth::crep()->get()->city_id*10;
                $user->school_id    = Session::get('school');
                $roll = ($user->squad == 'HAUTS') ? 'H' : 'J';
                $roll .= ($user->language == 'en') ? 'E' : 'H';
                $roll .= strval(Auth::crep()->get()->city->code) . '0';
                $lastroll = User::withTrashed()->where('roll', 'LIKE', "%$roll%")->count();
                $roll .= str_pad(strval($lastroll + 1), 4, "0", STR_PAD_LEFT);
                $user->roll = $roll;
                $user->year = 2015;
                $pass = str_random(6);
                $user->password = Hash::make($pass);
                $user->paid = true;
                $user->status = 1;
                $user->comments = 'Added by ' . Auth::crep()->get()->name . ' on ' . date('H:i:s d-m-Y', time());
                $user->save();
                $details .= '<tr>
                                <td>' . $user->name1 . '</td>
                                <td>' . $user->name2 . '</td>
                                <td>' . $user->roll . '</td>
                                <td>' . $pass . '</td>
                            </tr>';
            }
            File::move(public_path() . '/regs/uploads/' . $file, public_path() . '/regs/uploaded/' . $file);
            return View::make('crep.uploadedreg')->with('details', $details);
        } else {
            return Redirect::route('crepuploadreg');
        }
    }

    public function addschool()
    {
        $rules = array(
            'name'      => 'required|string|max:250',
            'address'   => 'required|string|max:250',
            'pincode'   => 'required|numeric|digits:6',
            'contact'   => 'required|string|max:250',
            'email'     => 'required|email'
        );
        $v = Validator::make(Input::all(),$rules);
        if($v->fails()) {
            return 'There are errors in input. Please refresh and try again.';
        }
        $school = new School;
        $school->name       = Input::get('name');
        $school->address    = Input::get('address');
        $school->pincode    = Input::get('pincode');
        $school->email      = Input::get('email');
        $school->contact    = Input::get('contact');
        $school->verified   = 1;
        $school->city_id    = Auth::crep()->get()->city_id;
        $school->comments   = 'Added by '.Auth::crep()->get()->name.' on '.date('H:i:s d-m-Y', time());
        $school->save();
        return '<option value="'.$school->id.'">'.$school->name.'</option>';
    }

    public function centres()
    {
        return View::make('crep.centres');
    }

    public function postcentres()
    {
        if(Input::has('add')) {
            $rules = array(
                'name'      => 'required|string|max:250',
                'address'   => 'required|string|max:250',
                'strength'  => 'required|numeric|min:0',
                'pincode'   => 'required|numeric|digits:6',
                'online'    => 'required|in:YES,NO'
            );
            $messages = array(
                'name.required'         => 'Name field is required',
                'address.required'      => 'Address field is required',
                'strength.required'     => 'Strength field is required',
                'pincode.required'      => 'Pincode field is required',
                'name.max'              => 'Name(max length):250',
                'address.max'           => 'Address(max length):250',
                'strength.min'          => 'Strength (min value):0',
                'strength.numeric'      => 'Strength can have only digits',
                'pincode.numeric'       => 'Pincode can have only digits',
                'pincode.digits'        => 'Pincode length has to be 6 digits',
                'online.required'       => 'Online option need to be selected',
                'online.in'             => 'Online value can be either YES or NO'
            );
            $v = Validator::make(Input::all(), $rules, $messages);
            if($v->fails()) {
                return Redirect::route('crepcentres')->withErrors($v);
            }
            $num = Centre::where('city_id', Auth::crep()->get()->city_id)->count();
            $centre = new Centre;
            $centre->name   = Input::get('name');
            $centre->address    = Input::get('address');
            $centre->pincode    = Input::get('pincode');
            $centre->strength   = Input::get('strength');
            $centre->left       = Input::get('strength');
            $centre->city_id    = Auth::crep()->get()->city_id;
            $centre->code       = strval(Auth::crep()->get()->city_id).chr($num+65);
            $centre->online     = Input::get('online');
            $centre->comments   = 'Added by '.Auth::crep()->get()->name.' on '.date('H:i:s d-m-Y', time());
            $centre->save();
            if(Input::get('online')=='YES' && User::where('paid',0)->where('centre_city',Auth::crep()->get()->city_id*10)->where('centre_id',null)->count() > 0) {
                $usernum = User::where('paid',0)->where('centre_city',Auth::crep()->get()->city_id*10)->where('centre_id',null)->count();
                if($usernum > intval($centre->strength)) {
                    $usernum = $centre->strength;
                }
                foreach(User::where('paid',0)->where('centre_city',Auth::crep()->get()->city_id*10)->take($usernum)->get() as $user)
                {
                    $pass = str_random(6);
                    $user->centre_id = $centre->id;
                    $user->result_pass = Crypt::encrypt($pass);
                    $user->save();
                }
                $centre->left = intval($centre->left) - $usernum;
                $centre->save();
            }
            return Redirect::route('crepcentres')->with('success','Centre Successfully Added');
        }
        return Redirect::route('crepcentres');
    }

    public function editcentre()
    {
        $id = Input::get('id');
        try {
            $id = Crypt::decrypt($id);
        } catch (Exception $e) {
            return 'There was some error. Please refresh the page before continuing.';
        }
        $centre = Centre::find(intval($id));
        $rules = array(
            'name'      => 'required|string|max:250',
            'address'   => 'required|string|max:250',
            'strength'  => 'required|numeric|min:'.strval($centre->strength-$centre->left),
            'pincode'   => 'required|numeric|digits:6',
            'online'    => 'required|in:YES,NO'
        );
        $messages = array(
            'name.required'         => 'Name field is required',
            'address.required'      => 'Address field is required',
            'strength.required'     => 'Strength field is required',
            'pincode.required'      => 'Pincode field is required',
            'name.max'              => 'Name(max length):250',
            'address.max'           => 'Address(max length):250',
            'strength.min'          => 'Strength (min value):'.strval($centre->strength-$centre->left),
            'strength.numeric'      => 'Strength can have only digits',
            'pincode.numeric'       => 'Pincode can have only digits',
            'pincode.digits'        => 'Pincode length has to be 6 digits',
            'online.required'       => 'Online option need to be selected',
            'online.in'             => 'Online value can be either YES or NO'
        );
        $v = Validator::make(Input::all(),$rules,$messages);
        if($v->fails()) {
            return 'There are errors in input. Please refresh and try again.';
        }
        $leftinc = Input::get('strength') -  $centre->strength;
        $centre->name       = Input::get('name');
        $centre->address    = Input::get('address');
        $centre->pincode    = Input::get('pincode');
        $centre->left       += $leftinc;
        $centre->strength   = Input::get('strength');
        $centre->online     = Input::get('online');
        $centre->save();
        if( $leftinc > 0 && $centre->online == 'YES' && User::where('paid',0)->where('centre_city',Auth::crep()->get()->city_id*10)->where('centre_id',null)->count() > 0) {
            $usernum = User::where('paid',0)->where('centre_city',Auth::crep()->get()->city_id*10)->where('centre_id',null)->count();
            if($usernum > intval($centre->left)) {
                $usernum = $centre->left;
            }
            foreach(User::where('paid',0)->where('centre_city',Auth::crep()->get()->city_id*10)->where('centre_id',null)->take($usernum)->get() as $user)
            {
                $pass = str_random(6);
                $user->centre_id = $centre->id;
                $user->result_pass = Crypt::encrypt($pass);
                $user->save();
            }
            $centre->left = intval($centre->left) - $usernum;
            $centre->save();
        }
        return 'Details Updated';
    }

    public function allotcentres()
    {
        $schools = User::where('city_id',Auth::crep()->get()->city_id)->where('paid',1)->groupBy('school_id')->get();
        $centres = Centre::where('city_id',Auth::crep()->get()->city_id)->where('left','>',0)->get();
        $opcent = '';
        foreach($centres as $centre) {
            $id = Crypt::encrypt($centre->id);
            while(strpos($id,'=') !== false) {
                $id = Crypt::encrypt($centre->id);
            }
            $opcent .= '<option data-limit ="'.$centre->left.'" value="'.$id.'">'.$centre->name.' ('.$centre->left.' teams left)</option>';
        }
        return View::make('crep.allotcentres2')->with('schools',$schools)->with('centres',$opcent);
    }

    public function funcallotcentre()
    {
        $school = Input::get('school');
        $centre = Input::get('centre');
        try {
            $school = Crypt::decrypt($school);
            $centre = Crypt::decrypt($centre);
            $centre = Centre::find($centre);
            $school = School::find($school);
        } catch (Exception $e) {
            return 'There was some error. Please refresh the page before continuing.';
        }
        $usercount = User::where('school_id',$school->id)->where('centre_city',Auth::crep()->get()->city_id*10)->where('paid',1)->whereNull('centre_id')->count();
        if($usercount == 0 || $centre->left == 0) {
            return 'Please refresh page and try again.';
        }
        if($usercount > ($centre->left)) {
            $num = $centre->left;
            foreach(User::where('school_id',$school->id)->where('centre_city',Auth::crep()->get()->city_id*10)->where('paid',1)->whereNull('centre_id')->take($num)->get() as $user) {
                $pass = str_random(6);
                $user->result_pass = Crypt::encrypt($pass);
                $user->centre_id = $centre->id;
                $user->save();
            }
            $centre->left = 0;
            $centre->save();
        }
        else {
            foreach(User::where('school_id',$school->id)->where('centre_city',Auth::crep()->get()->city_id*10)->where('paid',1)->whereNull('centre_id')->get() as $user) {
                $pass = str_random(6);
                $user->result_pass = Crypt::encrypt($pass);
                $user->centre_id = $centre->id;
                $user->save();
            }
            $centre->left = $centre->left - $usercount;
            $centre->save();
            $school->admitgenerated = false;
            $school->save();
        }
        return 'Centre successfully allotted';
    }

    public function generateadmitcards() {
        $school = Input::get('school');
        try {
            $school = Crypt::decrypt($school);
            $school = School::find($school);
        } catch (Exception $e) {
            return 'There was some error. Please refresh the page before continuing.';
        }
        if($school->city_id != Auth::crep()->get()->city_id) {
            return 'There was some error. Please refresh the page before continuing.';
        }
        $data = array('school'=>$school->id);
        return PDF::loadView('crep.admitcard',$data)->save('admit-cards/schools/'.$school->id.'.pdf');
        $school->admitgenerated = true;
        $school->save();
        return 'Admit Cards Generated';
    }

    public function admitdownload($school)
    {
        try {
            $school = Crypt::decrypt($school);
            $school = School::find($school);
        } catch (Exception $e) {
            return View::make('layouts.error');
        }
        return Response::download('admit-cards/schools/'.$school->id.'.pdf',$school->name.'.pdf',array('Content-type:application/pdf','filename'));
    }

    public function printadmit($school)
    {
        try {
            $school = Crypt::decrypt($school);
        } catch (Exception $e) {
            return View::make('layouts.error404');
        }
        return View::make('crep.admitcard')->with('school',$school);
    }


    public function onspot()
    {
        return View::make('crep.onspot');
    }

    public function onspotgenerate()
    {
        $rules = array(
            'squad'      => 'required|in:HAUTS,JUNIOR',
            'medium'   => 'required|in:en,hi',
            'qty'  => 'required|numeric|min:0'
        );
        $v = Validator::make(Input::all(),$rules);
        if($v->fails()) {
            return 'There are errors in input. Please refresh and try again.';
        }
        $squad  = Input::get('squad');
        $med    = Input::get('medium');
        $qty    = Input::get('qty');
        $usernum = User::where('city_id',Auth::crep()->get()->city_id)->where('squad',$squad)->where('language',$med)->where('status',3)->count();
        for($i=1;$i<=$qty;$i++)
        {
            $user = new User;
            $user->name1    = 'User1';
            $user->name2    = 'User2';
            $user->city_id  = Auth::crep()->get()->city_id;
            $user->centre_city  = Auth::crep()->get()->city_id*10;
            $user->paid     = 3;
            $user->status   = 3;
            $user->year     = 2015;
            $user->language = $med;
            $user->squad    = $squad;
            $roll           = $squad=='HAUTS'?'H':'J';
            $roll          .= $med=='en'?'E':'H';
            $roll          .= Auth::crep()->get()->city->code.'3'.str_pad(strval($usernum + $i), 4, "0", STR_PAD_LEFT);
            $user->roll     = $roll;
            $user->school_id = 0;
            $user->result_pass = Crypt::encrypt(str_random(6));
            $user->save();
        }
        return 'Forms Generated';
    }

    public function onspotdownload($squad,$med)
    {
        return View::make('crep.onspotadmit',array('med'=>$med, 'squad'=>$squad));
//        return $file;
//        $name = Auth::crep()->get()->city->name;
//        $name .= str_contains($file,'JUNIOR')?'-JUNIOR':'-HAUTS';
//        $name .= str_contains($file,'en')?'-English':'-Hindi';
//        $name .= ' On-spot Forms.pdf';
//        return Response::download('admit-cards/onspot/'.$file.'.pdf',$name,array('Content-type:application/pdf','filename'));
    }

    public function attendance($centre)
    {
        try {
            $centre = Crypt::decrypt($centre);
            $centre = Centre::find($centre);
        } catch (Exception $e) {
            return View::make('layouts.error');
        }
        Excel::create($centre->name, function ($excel) use ($centre) {
            $excel->setTitle('Attendance Sheet');
            $excel->setCreator('Technothlon')
                ->setCompany('Technothlon');
            $excel->setDescription('Attendance Sheet for '.$centre->name);

            $excel->sheet('Offline', function ($sheet) use ($centre) {
                $sheet->appendRow(array('Name 1', 'Name 2', 'School', 'Roll'));
                $users = array();
                foreach (User::where('centre_id', $centre->id)->wherePaid(1)->orderBy('school_id')->get() as $user) {
                    $users[] = array($user->name1, $user->name2, $user->school->name, $user->roll);
                }
                $sheet->rows($users);
            });

            $excel->sheet('Online', function ($sheet) use ($centre) {
                $sheet->appendRow(array('Name 1', 'Name 2', 'School', 'Roll'));
                $users = array();
                foreach (User::where('centre_id', $centre->id)->wherePaid(0)->orderBy('school_id')->get() as $user) {
                    $users[] = array($user->name1, $user->name2, $user->school->name, $user->roll);
                }
                $sheet->rows($users);
            });

        })->export('xlsx');
    }

    public function download($file = null)
    {
        if($file == null) {
            return View::make('crep.download');
        }
        return Response::download(storage_path().'/files/download/'.$file.'.pdf');
    }

    public function test()
    {
//        $result='';
//        foreach(CityRep::orderBy('name')->get() as $school) {
//            if(CityRep::where('email',$school->email)->count() >1) {
//                $result .= $school->name.'  '.$school->city.'<br>';
//            }
//        }
        $pass = str_random(6);
        return $pass.'<br>'.Hash::make($pass).'<br>'.Crypt::encrypt($pass);
        $data = array('school' => 17);
        $pdf = new TCPDF();

        $pdf->SetPrintHeader(false);
        $pdf->SetPrintFooter(false);
        $pdf->AddPage();
        $view = View::make('crep.admitcard2',$data);
        $pdf->writeHTML($view,true,0,true,0);
        $pdf->lastPage();
        $filename = storage_path() . '/test.pdf';
        $pdf->Output($filename, 'I');
        $headers = array(
            'Content-Type' => 'application/pdf',
        );
        return Response::make($pdf, 200, $headers);
//        return $view;
        return Response::download($filename);
    }
}
