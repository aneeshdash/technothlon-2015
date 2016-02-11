<?php
$count=CityRep::where('city_id', $city)->count();
echo $count;