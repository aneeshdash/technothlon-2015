<option value="">Select School</option>
@foreach(School::where('city_id', $city)->orderBy('name')->get() as $school)
<option value="{{ $school->id }}">{{ $school->name }}</option>
@endforeach
<option value="other">Other</option>