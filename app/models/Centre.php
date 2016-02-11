<?php
/**
 * Created by PhpStorm.
 * User: aneeshdash
 * Date: 27/11/14
 * Time: 10:41 AM
 */

class Centre extends Eloquent {
    use SoftDeletingTrait;
    protected $table='centres';

    function city() {
        return $this->belongsTo('City');
    }
    function registration() {
        return $this->hasMany('User');
    }

} 