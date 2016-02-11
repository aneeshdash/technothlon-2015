<div id="city-rep-heading">City Representatives in your city</div>
@foreach(CityRep::where('city_id', $city)->orderBy('priority','desc')->get() as $cityrep)
<div class="person">
<div class="name">
    @if($cityrep->gender === 'MALE')
        <div class="sprite-contact boy"></div>
    @else
        <div class="sprite-contact girl"></div>
    @endif
<div class="inline-block">{{ $cityrep->name }}</div></div>
<div class="phone-number"><div class="sprite-contact phone"></div><div class="inline-block"><a href="tel:+91{{ $cityrep->contact_home }}">(+91) {{ $cityrep->contact_home }}</a></div></div>
<div class="person-mail"><div class="sprite-contact email"></div><div class="inline-block"><a href="mailto:{{ $cityrep->email }}">{{ $cityrep->email }}</a></div></div>
</div>
@endforeach