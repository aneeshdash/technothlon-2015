@extends('layouts.master')
@section('title')
    Learn Experience Discover
@endsection
@section('description')
    LED is an initiative by Technothlon where we we demonstrate to the school students, simple experiments,
    so as to explain to them the basic principles of science which otherwise they might be learning by rote.
@endsection
@section('head')
    <link rel="stylesheet" type="text/css" href="{{ asset('CSS/led.css') }}">
@endsection
@section('body')
    <div class="container">
        <div class="in-container">
            <div id="slides" style="height: 365px">
                <img src="{{ asset('images/led.png') }}">
                <img src="{{ asset('img/led3.jpg') }}" alt="Photo by: Missy S Link: http://www.flickr.com/photos/listenmissy/5087404401/">
                <img src="{{ asset('img/example-slide-2.jpg') }}" alt="Photo by: Daniel Parks Link: http://www.flickr.com/photos/parksdh/5227623068/">
                <img src="{{ asset('img/example-slide-3.jpg') }}" alt="Photo by: Mike Ranweiler/">
                <img src="{{ asset('img/example-slide-4.jpg') }}" alt="Photo by: Stuart SeegerLink: http://www.flickr.com/photos/stuseeger/97577796/">
            </div>
        </div>
        <div class="in-container">
            Technothlon, started with the aim of inspiring young minds, in its eleven years of span, has strived to
            identify the budding talent across the country and nurture and inspire them to be great future leaders
            of the country. With each and every possible way out to promote out of the box thinking amongst the
            students, Technothlon had started with its new campaign “Learn.Experience.Discover(LED)”.
            Through this initiative, we demonstrate to the school students, simple experiments, so as to explain to
            them the basic principles of science which otherwise they might be learning by rote. How many of you in
            your school days felt it was difficult to follow even the fundamentals of science or else it made you
            feel like a book worm while turning the pages of your book and learning those definitions. Now, imagine,
            those very concepts are explained to you in a lucid manner using simple objects of everyday life. You
            would not even find it interesting and enjoyable but also, very less are the chances that you will
            forget those principles ever in your life.
        </div>
        <br>
    </div>
    <div class="container">
        <div class="in-container">
            With the vision to reach to each and every child in the country, we need a movement of leaders across
            all sectors that are committed to, and will work towards, helping us in realising our endeavor of
            inspiring young minds. Those who think, they are capable of putting a transformational impact on the
            students and being our partners in inspiring young minds may join us and <a href="{{ route('contact') }}" target="_blank">contact us</a> for other details.<br>
        </div>
        </div>
    <script src="{{ asset('js/jquery.slides.js') }}"></script>
    <script>
        $(function() {
            $('#slides').slidesjs({
                        width: 467,
                        height: 365
                    }
            );
        });
        $(document).ready(function () {
            setTimeout(function(){$('a.slidesjs-play').click(); $('#slides').animate({height: '100%'}, 1000)}, 5000);

        });
    </script>
@endsection