<?php
/**
 * Created by PhpStorm.
 * User: aneeshdash
 * Date: 27/11/14
 * Time: 10:34 AM
 */

class City extends Eloquent {

    protected $table='cities';

    function school() {
        return $this->belongsToMany('School');
    }
    function registration() {
        return $this->belongsToMany('User');
    }
    function cityrep() {
        return $this->belongsToMany('CityRep');
    }
    function centre() {
        return $this->belongsToMany('Centre');
    }
    function state() {
        return $this->belongsTo('State');
    }

} 