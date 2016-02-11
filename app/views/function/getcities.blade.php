<option value="">Select City</option>
@foreach(City::where('state_id', $state)->get() as $city)
<option value="{{ $city->id }}">{{ $city->name }}</option>
@endforeach