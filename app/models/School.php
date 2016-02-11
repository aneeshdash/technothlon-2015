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
        return $this->hasOne('City');
    }
    function registrations() {
        return $this->belongsToMany('User');
    }
    function name() {
        return $this->hasOne('name');
    }
    function  addr() {
        return $this->hasOne('addr');
    }

} 