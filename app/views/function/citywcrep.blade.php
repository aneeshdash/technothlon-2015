@foreach(City::where('state_id', $state)->get() as $city)
    @if(CityRep::where('city_id', $city->id)->count() >0)
        <option value="{{ $city->id }}">{{ $city->name }}</option>
    @endif
@endforeach