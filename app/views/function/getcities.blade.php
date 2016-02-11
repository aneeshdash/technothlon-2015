<option value="">Select City</option>
@foreach(City::where('state_id', $state)->orderBy('name')->get() as $city)
<option value="{{ $city->id }}">{{ $city->name }}</option>
@endforeach