<?php
/**
 * Created by PhpStorm.
 * User: aneeshdash
 * Date: 27/11/14
 * Time: 10:43 AM
 */

class CityRep extends Eloquent {

    use SoftDeletingTrait;

    protected $table='cityreps';

    function city() {
        return $this->hasOne('City');
    }

} 