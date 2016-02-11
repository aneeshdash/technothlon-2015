<?php
/**
 * Created by PhpStorm.
 * User: aneeshdash
 * Date: 27/11/14
 * Time: 10:41 AM
 */

class Centre extends Eloquent {
    protected $table='centres';

    function city() {
        return $this->hasOne('City');
    }
    function registration() {
        return $this->belongsToMany('User');
    }

} 