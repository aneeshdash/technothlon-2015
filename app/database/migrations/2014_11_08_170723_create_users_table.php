<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
        Schema::create('admins', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->string('username');
            $table->string('password');
            $table->bigInteger('contact');
            $table->string('email');
            $table->string('techno_email');
            $table->enum('region',['NORTH','SOUTH','EAST','WEST','CENTRAL']);
            $table->enum('gender',['MALE','FEMALE']);
            $table->rememberToken();
            $table->timestamps();
            $table->softDeletes();
        });

        Schema::create('centres', function(Blueprint $table)
        {
            $table->increments('id');
            $table->string('name');
            $table->string('address', 1000);
            $table->integer('pincode');
            $table->integer('city_id');
            $table->string('code',11);
            $table->integer('strength');
            $table->integer('left');
            $table->enum('online', ['YES', 'NO']);
            $table->string('comments');
            $table->timestamps();
            $table->softDeletes();
        });

        Schema::create('cities', function(Blueprint $table)
        {
            $table->increments('id');
            $table->string('name');
            $table->integer('code');
            $table->unsignedInteger('state_id');
            $table->enum('region', ['NORTH', 'SOUTH', 'EAST', 'WEST', 'CENTRAL']);
            $table->integer('online',5);
            $table->string('comments');
            $table->timestamps();
            $table->softDeletes();
        });

        Schema::create('cityreps', function(Blueprint $table)
        {
            $table->increments('id');
            $table->string('name');
            $table->bigInteger('contact_home');
            $table->bigInteger('contact_iitg');
            $table->string('email');
            $table->string('webmail');
            $table->integer('city_id');
            $table->enum('gender', ['MALE', 'FEMALE'])->default('MALE');
            $table->string('password', 128);
            $table->rememberToken();
            $table->tinyInteger('priority')->default(0);
            $table->timestamps();
            $table->softDeletes();
            $table->string('comments');
        });

        Schema::create('faqs', function(Blueprint $table) {
            $table->increments('id');
            $table->string('question', 1000);
            $table->string('answer', 10000);
            $table->integer('priority');
        });

        Schema::create('feedback', function(Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->string('email');
            $table->string('suggestion', 10000);
            $table->timestamps();
        });

        Schema::create('registrations', function(Blueprint $table)
        {
            $table->bigIncrements('id');
            $table->timestamps();
            $table->string('name1');
            $table->string('name2');
            $table->bigInteger('contact1');
            $table->bigInteger('contact2');
            $table->string('email1');
            $table->string('email2');
            $table->enum('squad', ['JUNIOR', 'HAUTS']);
            $table->string('roll');
            $table->enum('language', ['hi', 'en'])->default('en');
            $table->integer('school_id');
            $table->integer('city_id');
            $table->integer('centre_id');
            $table->bigInteger('centre_city');
            $table->boolean('paid')->default(false);
            $table->string('user_id');
            $table->string('password', 128);
            $table->string('result_pass');
            $table->rememberToken();
            $table->integer('year');
            $table->string('comments');
            $table->softDeletes();
            $table->integer('status',5);
            $table->boolean('mail');
        });

        Schema::create('results_2015', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('roll',15);
            $table->integer('score');
            $table->bigInteger('mobile');
            $table->integer('error',5);
            $table->string('filename');
            $table->string('path');
            $table->integer('kv',5);
            $table->string('q1',5);
            $table->string('q2',5);
            $table->string('q3',5);
            $table->string('q4',5);
            $table->string('q5',5);
            $table->string('q6',5);
            $table->string('q7',5);
            $table->string('q8',5);
            $table->string('q9',5);
            $table->string('q10',5);
            $table->string('q12',5);
            $table->string('q13',5);
            $table->string('q14',5);
            $table->string('q15',5);
            $table->string('q16',5);
            $table->string('q17',5);
            $table->string('q18',5);
            $table->string('q19',5);
            $table->string('q30',5);
            $table->string('q21',5);
            $table->string('q22',5);
            $table->string('q23',5);
            $table->string('q24',5);
            $table->enum('conf1',['Y','N']);
            $table->enum('conf2',['Y','N']);
        });

        Schema::create('schools', function(Blueprint $table)
        {
            $table->increments('id');
            $table->timestamps();
            $table->string('name');
            $table->string('address');
            $table->integer('pincode');
            $table->string('email');
            $table->string('contact');
            $table->integer('city_id');
            $table->boolean('verified')->default(false);
            $table->string('comments');
            $table->softDeletes();
            $table->admitgenerated();
        });

        Schema::create('states', function(Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->enum('region', ['NORTH', 'SOUTH', 'WEST', 'CENTRAL', 'EAST']);
            $table->timestamps();
            $table->softDeletes();
        });

        Schema::create('technopedia_ques', function (Blueprint $table) {
            $table->increments('id');
            $table->string('ques_id',11);
            $table->mediumText('body');
            $table->string('answer',100);
        });

        Schema::create('technopedia_response', function (Blueprint $table) {
            $table->increments('id');
            $table->timestamps();
            $table->string('roll',20);
            $table->integer('score',20);
            $table->string('month',10);
            $table->softDeletes();
        });

	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{

	}

}
