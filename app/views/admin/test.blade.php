@extends('admin.master')
@section('head')
    <meta http-equiv="refresh" content="3">
    @endsection
@section('content')
    <section class="content">
        <div class="row">
            <div class="col-sm-12">
                <table class="table table-bordered">
                    <tr>
                        <th>Name</th>
                        <th>Contact</th>
                        <th>City</th>
                        <th>State</th>
                    </tr>
                    @foreach(City::where('region','CENTRAL')->where('code','>',100)->orderBy('state_id')->get() as $city)
                        @foreach(CityRep::where('city_id',$city->id)->get() as $crep)
                            <tr>
                                <td>{{ $crep->name }}</td>
                                <td>{{ $crep->contact_home }}</td>
                                <td>{{ $crep->city['name'] }}</td>
                                <td>{{ $crep->city->state->name }}</td>
                            </tr>
                            @endforeach
                        @endforeach
                </table>
            </div>
        </div>
    </section>
    @endsection