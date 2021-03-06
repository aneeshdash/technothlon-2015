<?php

use Illuminate\Auth\UserTrait;
use Illuminate\Auth\UserInterface;
use Illuminate\Auth\Reminders\RemindableTrait;
use Illuminate\Auth\Reminders\RemindableInterface;

class State extends Eloquent{
	use SoftDeletingTrait;
    protected $table = 'states';


    function cities() {
        return $this->hasMany('City');
    }
}
