<?php
/**
 * Created by PhpStorm.
 * User: aneeshdash
 * Date: 27/11/14
 * Time: 10:31 AM
 */

class School extends Eloquent {

    use SoftDeletingTrait;

    protected $table='schools';

    function city() {
        return $this->belongsTo('City');
    }
    function registrations() {
        return $this->hasMany('User');
    }
    function state() {
        return $this->belongsTo('State');
    }

} 