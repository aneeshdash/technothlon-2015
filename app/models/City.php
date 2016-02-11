<?php
/**
 * Created by PhpStorm.
 * User: aneeshdash
 * Date: 27/11/14
 * Time: 10:34 AM
 */

class City extends Eloquent {
    use SoftDeletingTrait;
    protected $table='cities';

    function school() {
        return $this->hasMany('School');
    }
    function registration() {
        return $this->hasMany('User');
    }
    function cityrep() {
        return $this->hasMany('CityRep');
    }
    function centre() {
        return $this->hasMany('Centre');
    }
    function state() {
        return $this->belongsTo('State');
    }

} 