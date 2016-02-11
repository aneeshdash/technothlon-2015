<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the Closure to execute when that URI is requested.
|
*/

Route::get('/', ['as' => 'home', 'uses' => 'HomeController@home']);
Route::get('about', ['as' => 'about', 'uses' => 'HomeController@about']);
Route::get('contact', ['as' => 'contact', 'uses' => 'HomeController@contact']);
Route::get('downloads', ['as' => 'downloads', 'uses' => 'HomeController@downloads']);
Route::get('faqs', ['as' => 'faqs', 'uses' => 'HomeController@faqs']);
Route::get('led', ['as' => 'led', 'uses' => 'HomeController@led']);
Route::get('technofin', ['as' => 'technofin', 'uses' => 'HomeController@technofin']);
Route::get('videos', ['as' => 'videos', 'uses' => 'HomeController@videos']);
Route::get('registrations', ['as' => 'registrations', 'uses' => 'HomeController@registrations']);
Route::get('register', ['as' => 'register', 'uses' => 'HomeController@register']);
Route::post('register', ['as' => 'register', 'uses' => 'HomeController@postregister']);
Route::get('technopedia', ['as' => 'technopedia', 'uses' => 'HomeController@technopedia']);
Route::get('technopedia/login', ['as' => 'technopedialogin', 'uses' => 'HomeController@technopedialogin']);
Route::post('technopedia/login', ['as' => 'technopedialogin', 'uses' => 'HomeController@posttechnopedialogin']);
Route::get('technopedia/forgot', ['as' => 'forgot', 'uses' => 'HomeController@forgot']);
Route::post('technopedia/forgot', ['as' => 'forgot', 'uses' => 'HomeController@postforgot']);
Route::get('technopedia/rollrecover', ['as' => 'rollrecover', 'uses' => 'HomeController@rollrecover']);
Route::post('technopedia/rollrecover', ['as' => 'rollrecover', 'uses' => 'HomeController@postrollrecover']);
Route::post('technopedia/rollmail', ['as' => 'rollmail', 'uses' => 'HomeController@rollmail']);
Route::get('technopedia/leaderboard', ['as' => 'leaderboard', 'uses' => 'HomeController@leaderboard']);
Route::get('technopedia/previous/{month?}', ['as' => 'pques', 'uses' => 'HomeController@pques'])->where('month','\b(?:jan(?:uary)?|feb(?:ruary)?$)'); //|mar(?:ch)?|apr(?:il)?|may?|jun(?:e)?|jul(?:y)?;
Route::post('technopedia/previous/{month}', ['as' => 'pques', 'uses' => 'HomeController@pques'])->where('month','\b(?:jan(?:uary)?|feb(?:ruary)?$)'); //|mar(?:ch)?|apr(?:il)?|may?|jun(?:e)?|jul(?:y)?;
Route::get('schoolapprove', ['as' => 'schoolapprove', 'uses' => 'HomeController@schoolapprove']);
Route::get('feedback', ['as' => 'feedback', 'uses' => 'HomeController@feedback']);
Route::post('feedback', ['as' => 'feedback', 'uses' => 'HomeController@postfeedback']);
Route::post('getcities', ['as' => 'getcities', 'uses' => 'HomeController@getcities']);
Route::post('citywcrep', ['as' => 'citywcrep', 'uses' => 'HomeController@citywcrep']);
Route::get('citywcrep', ['as' => 'citywcrep', 'uses' => 'HomeController@citywcrep']);
Route::post('schoollist', ['as' => 'schoollist', 'uses' => 'HomeController@schoollist']);
Route::post('getcityrep', ['as' => 'getcityrep', 'uses' => 'HomeController@getcityrep']);
Route::post('cityrep_present', ['as' => 'cityrep_present', 'uses' => 'HomeController@cityrep_present']);
//Route::get('test/{month}', ['as' => 'test', 'uses' => 'HomeController@test']);//->where('month','\b(?:jan(?:uary)?|feb(?:ruary)?$)'); //|mar(?:ch)?|apr(?:il)?|may?|jun(?:e)?|jul(?:y)?
Route::get('test', ['as' => 'test', 'uses' => 'HomeController@test']);
Route::get('test2', ['as' => 'test2', 'uses' => 'HomeController@test2']);
Route::get('regmail', ['as' => 'regmail', 'uses' => 'HomeController@regmail']);
Route::post('schoolupdate', ['as' => 'schoolupdate', 'uses' => 'HomeController@schoolupdate']);
Route::post('schoolreplace', ['as' => 'schoolreplace', 'uses' => 'HomeController@schoolreplace']);
Route::get('registered', ['as' => 'registered', 'uses' => 'HomeController@registered']);
Route::get('citymail', ['as' => 'citymail', 'uses' => 'HomeController@citymail']);
Route::post('citymail', ['as' => 'citymail', 'uses' => 'HomeController@postcitymail']);
Route::get('citymail2', ['as' => 'citymail2', 'uses' => 'HomeController@postcitymail']);
Route::get('mail', ['as' => 'mailjnvs', 'uses' => 'HomeController@mailjnvs']);
Route::post('queue/offmail', function() { return Queue::marshal(); });
Route::get('certi', ['as' => 'certi', 'uses' => 'HomeController@certi']);
Route::get('checkomr/{id?}', ['as' => 'checkomr', 'uses' => 'HomeController@checkomr']);
Route::get('checkomr2/{id?}', ['as' => 'checkomr2', 'uses' => 'HomeController@checkomr2']);
Route::get('checkomrnotscan/{id?}', ['as' => 'checkomr3', 'uses' => 'HomeController@checkomr3']);
Route::get('checkomrnoschool/{id?}', ['as' => 'checkomr4', 'uses' => 'HomeController@checkomr4']);
Route::get('checkomrnoteam/{id?}', ['as' => 'checkomr5', 'uses' => 'HomeController@checkomr5']);
Route::post('checkomr', ['as' => 'checkomr', 'uses' => 'HomeController@checkedomr']);
Route::get('omrtest/{id?}', ['as' => 'omrtest', 'uses' => 'HomeController@omrtest']);
Route::get('result/login', ['as' => 'resultlogin', 'uses' => 'HomeController@resultlogin']);
Route::post('result/login', ['as' => 'resultlogin', 'uses' => 'HomeController@postresultlogin']);
Route::get('results', ['as' => 'results', 'uses' => 'HomeController@results']);


Route::group(array('before' => 'auth.user'), function () {
    Route::post('technopedia/question', ['as' => 'question', 'uses' => 'HomeController@question']);
    Route::get('technopedia/start', ['as' => 'starttechnopedia', 'uses' => 'HomeController@starttechnopedia']);
    Route::get('technopedia/end', ['as' => 'endtechnopedia', 'uses' => 'HomeController@endtechnopedia']);
    Route::get('admitcard', ['as' => 'admitcard', 'uses' => 'HomeController@admitcard']);
    Route::get('admitcard/download', ['as' => 'admitcarddown', 'uses' => 'HomeController@admitcarddownload']);
    Route::get('logout', ['as' => 'logout', 'uses' => 'HomeController@logout']);
    Route::get('centrechange', ['as' => 'centrechange', 'uses' => 'HomeController@centrechange']);
    Route::post('centrechange', ['as' => 'centrechange', 'uses' => 'HomeController@centrechanged']);
    Route::get('result', ['as' => 'result', 'uses' => 'HomeController@result']);
    Route::get('result/confirm', ['as' => 'confdetails', 'uses' => 'HomeController@confirmDetails']);
    Route::post('result/confirm', ['as' => 'confdetails', 'uses' => 'HomeController@postconfirmDetails']);
    Route::get('result/certificate/{name}', ['as' => 'certi', 'uses' => 'HomeController@certi']);
    Route::get('certificate/', ['as' => 'certificate', 'uses' => 'HomeController@certificate']);
    Route::get('certificate/download/{squad}/{name}', ['as' => 'certificatedownload', 'uses' => 'HomeController@certificatedownload']);

});

Route::group(array('prefix' => 'cityrep'),function () {
    Route::get('login', ['as' => 'creplogin', 'uses' => 'CRepController@login']);
    Route::post('login', ['as' => 'creplogin', 'uses' => 'CRepController@postlogin']);
    Route::get('forgot', ['as' => 'crepforgot', 'uses' => 'CRepController@forgot']);
    Route::post('forgot', ['as' => 'crepforgot', 'uses' => 'CRepController@postforgot']);
    Route::get('test', ['as' => 'test', 'uses' => 'CRepController@test']);
    Route::group(array('before'=>'auth.cityrep'),function()
    {
        Route::get('registrations', ['as' => 'crepregs', 'uses' => 'CRepController@regs']);
        Route::get('logout', array('as' => 'creplogout', 'uses' => 'CRepController@logout'));
        Route::get('profile', array('as' => 'crepprofile', 'uses' => 'CRepController@profile'));
        Route::post('profile', array('as' => 'creppostprofile', 'uses' => 'CRepController@editprofile'));
        Route::post('changepassword', array('as' => 'crepchpass', 'uses' => 'CRepController@chpass'));
        Route::get('uploadreg', ['as' => 'crepuploadreg', 'uses' => 'CRepController@uploadreg']);
        Route::post('uploadreg', ['as' => 'crepuploadreg', 'uses' => 'CRepController@postuploadreg']);
        Route::get('uploadedreg', ['as' => 'crepuploadedreg', 'uses' => 'CRepController@uploadedreg']);
        Route::get('centres', ['as' => 'crepcentres', 'uses' => 'CRepController@centres']);
        Route::post('centres', ['as' => 'crepcentres', 'uses' => 'CRepController@postcentres']);
        Route::get('centres/allot', ['as' => 'crepallotcentres', 'uses' => 'CRepController@allotcentres']);
//        Route::get('admitcard/{school}', ['as' => 'crepadmitdown', 'uses' => 'CRepController@admitdownload']);
        Route::get('admitcard/{school}', ['as' => 'crepadmitprint', 'uses' => 'CRepController@printadmit']);
        Route::get('centres/attendance/{centre}', ['as' => 'crepattendance', 'uses' => 'CRepController@attendance']);
        Route::get('onspot', ['as' => 'creponspot', 'uses' => 'CRepController@onspot']);
        Route::get('onspotdownload/{squad}/{med}', ['as' => 'creponspotdown', 'uses' => 'CRepController@onspotdownload'])->where('squad','JUNIOR|HAUTS')->where('med','hi|en');
        Route::get('download/{file?}', ['as' => 'crepdown', 'uses' => 'CRepController@download']);
        Route::group(array('before' => 'func'), function () {
            Route::post('editcentre', ['as' => 'crepeditcentre', 'uses' => 'CRepController@editcentre']);
            Route::post('addschool', ['as' => 'crepaddschool', 'uses' => 'CRepController@addschool']);
            Route::post('allotcentre', ['as' => 'crepfuncallotcentre', 'uses' => 'CRepController@funcallotcentre']);
            Route::post('generateadmit', ['as' => 'crepfuncgenadmit', 'uses' => 'CRepController@generateadmitcards']);
            Route::post('onspot', ['as' => 'creponspotgen', 'uses' => 'CRepController@onspotgenerate']);
        });
    });
});

Route::group(array('prefix' => 'toor'),function () {
    Route::get('login', ['as' => 'adminlogin', 'uses' => 'AdminController@login']);
    Route::post('login', ['as' => 'adminlogin', 'uses' => 'AdminController@postlogin']);
    Route::get('forgot', ['as' => 'adminforgot', 'uses' => 'AdminController@forgot']);
    Route::post('forgot', ['as' => 'adminforgot', 'uses' => 'AdminController@postforgot']);
    Route::get('test', ['as' => 'test', 'uses' => 'AdminController@test']);
    Route::get('certi', ['as' => 'certi', 'uses' => 'AdminController@certi']);
    Route::get('checkresult', ['as' => 'checkresult', 'uses' => 'AdminController@checkresult']);
    Route::group(array('before' => 'auth.admin'), function () {
        Route::get('registrations', ['as' => 'adminregs', 'uses' => 'AdminController@regs']);
        Route::post('registrations', ['as' => 'adminregs', 'uses' => 'AdminController@postregs']);
        Route::get('logout', array('as' => 'adminlogout', 'uses' => 'AdminController@logout'));
        Route::get('profile', array('as' => 'adminprofile', 'uses' => 'AdminController@profile'));
        Route::post('profile', array('as' => 'adminpostprofile', 'uses' => 'AdminController@editprofile'));
        Route::post('changepassword', array('as' => 'adminchpass', 'uses' => 'AdminController@chpass'));
        Route::get('generatepasswords', ['as' => 'generatepasswords', 'uses' => 'AdminController@generatepasswords']);
        Route::post('generatepasswords', ['as' => 'generatedpasswords', 'uses' => 'AdminController@generatedpasswords']);
        Route::get('uploadreg', ['as' => 'adminuploadreg', 'uses' => 'AdminController@uploadreg']);
        Route::post('uploadreg', ['as' => 'adminuploadreg', 'uses' => 'AdminController@postuploadreg']);
        Route::get('uploadedreg', ['as' => 'adminuploadedreg', 'uses' => 'AdminController@uploadedreg']);
        Route::get('kvfilegenerate', ['as' => 'kvfile', 'uses' => 'AdminController@kvfilegenerate']);
        Route::get('download/{file?}', ['as' => 'admindown', 'uses' => 'AdminController@download']);
        Route::get('uploadres', ['as' => 'adminuploadres', 'uses' => 'AdminController@uploadres']);
        Route::post('uploadres', ['as' => 'adminuploadres', 'uses' => 'AdminController@postuploadres']);
        Route::get('kvregs', ['as' => 'kvregs', 'uses' => 'AdminController@kvregs']);
        Route::get('adminscore', ['as' => 'adminscore', 'uses' => 'AdminController@adminscore']);
        Route::post('scoreupdate', ['as' => 'scoreupdate', 'uses' => 'AdminController@scoreupdate']);
        Route::post('updatescore', ['as' => 'updatescore', 'uses' => 'AdminController@updatescore']);
        Route::get('score', ['as' => 'score', 'uses' => 'AdminController@score']);
        Route::get('hautsadminscore', ['as' => 'hautsadminscore', 'uses' => 'AdminController@hautsadminscore']);
        Route::post('hautsscoreupdate', ['as' => 'hautsscoreupdate', 'uses' => 'AdminController@hautsscoreupdate']);
        Route::post('hautsupdatescore', ['as' => 'hautsupdatescore', 'uses' => 'AdminController@hautsupdatescore']);


        Route::group(array('prefix' => 'func'), function () {
            Route::post('deleteregs', array('as' => 'admindeleteregs', 'uses' => 'AdminController@deleteregs'));
            Route::post('editregs', array('as' => 'admineditregs', 'uses' => 'AdminController@editregs'));
        });
    });
});