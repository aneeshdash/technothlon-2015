<?php

return array(

	/*
	|--------------------------------------------------------------------------
	| Third Party Services
	|--------------------------------------------------------------------------
	|
	| This file is for storing the credentials for third party services such
	| as Stripe, Mailgun, Mandrill, and others. This file provides a sane
	| default location for this type of information, allowing packages
	| to have a conventional place to find your various credentials.
	|
	*/

	'mailgun' => array(
		'domain' => 'techniche.org',
		'secret' => 'key-7c4b03a1c4b68aa332a76e2ce11e7e31',
	),

	'mandrill' => array(
		'secret' => 'd9jnjtiwFCfowAQtBB9F4g',
	),

	'stripe' => array(
		'model'  => 'User',
		'secret' => '',
	),

);
