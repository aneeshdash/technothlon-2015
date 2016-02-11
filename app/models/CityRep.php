<?php
/**
 * Created by PhpStorm.
 * User: aneeshdash
 * Date: 27/11/14
 * Time: 10:43 AM
 */
use Illuminate\Auth\UserTrait;
use Illuminate\Auth\UserInterface;
use Illuminate\Auth\Reminders\RemindableTrait;
use Illuminate\Auth\Reminders\RemindableInterface;

class CityRep extends Eloquent implements UserInterface {

    use UserTrait, RemindableTrait, SoftDeletingTrait;

    protected $table='cityreps';

    function city() {
        return $this->belongsTo('City');
    }

} 