@extends('layouts.master')
@section('title')
    Technofin
@endsection
@section('description')
    Technofin is an initiative by Technothlon where we we demonstrate to the school students, simple experiments,
    so as to explain to them the basic principles of science which otherwise they might be learning by rote.
@endsection
@section('head')
    <link rel="stylesheet" type="text/css" href="{{ asset('CSS/led.css') }}">
    <link href='http://fonts.googleapis.com/css?family=Indie+Flower' rel='stylesheet' type='text/css'>
    <link href='http://fonts.googleapis.com/css?family=Fredoka+One' rel='stylesheet' type='text/css'>
@endsection
@section('body')
    <div class="container">
        <div class="in-container" style="text-align: center">
            <img src="{{ asset('images/technofin.png') }}" width="100%">
            <br><br>
        </div>
        <div class="in-container" style="text-align: center;font-family: 'Indie Flower', cursive; color: #6C1E19; font-size: 26px">
            <i>“What good is it if high-school students learn about Flaubert, biology, and trigonometry if they don’t learn how to take care of their money?”</i>
        </div><br>
        <div class="in-container">
            <h2 style="font-family: 'Fredoka One', cursive;color: #9e2020;text-align: left">TechnoFin: Igniting Financial Awareness in the Youth</h2>
            USA Today reports a recent study stating that students exposed to financial literacy education in their early years of high school tend to be better with managing their money and credit situation as compared to those who have not had such an opportunity.<br><br>
            The same sentiment is echoed by authors as well as successful business people like Robert Kiyosaki, the author of the bestselling book “Rich Dad Poor Dad” emphasizing on the need of financial literacy as a skill set to achieve financial Independence. “The world is full of smart poor people” – is what he says to state that financial literacy in addition to the  professional skill will enable one to drive towards financial prosperity. An early starter himself having purchased his first stock at 11 years old, Warren Buffet says,” Financial literacy is a base requirement like spelling or reading or something of the sort that everybody should acquire at an early age”.<br><br>
            The RBI has undertaken a project titled: “Project Financial Literacy” to provide financial information to various target groups in the country. The present India is developing with leaps and bounds with a fresh spirit of entrepreneurship. Not only has there been an outburst of fresh ideas but also political revolutions, where the youth participates and freely voices opinion. Surely India is a land of opportunities, but does our present education system equip us with the requisite financial skills to manage our financial future? The answer is a resounding no. It ranks the lowest among 16 countries in the Asia-pacific region according to MasterCard’s index for financial literacy.<br><br>
            For a growing country, whose 50% of the population is below the age of 30, financial illiteracy is an alarming threat.  It’s high time to understand the necessity to possess financial and economic knowledge in order to manage ourselves as well as become informed citizens of India. TechnoFin is such an endeavor to spark interest among the youth in our schools regarding this important yet unexplored domain. We aim to simplify and demystify concepts related to money, investment, and finance.<br>

        </div>
        <br>
    </div>
    <div class="container">
        <div class="in-container">
            <h2>Guidelines:</h2>
            <p>
                <ol>
                <li>The exam would have 2 separate question papers. Standard 9th-10th comprise the Junior squad and Standard 11th-12th comprise the Hauts squad.</li>
                <li>The format of the paper is purely objective.</li>
                <li>Financial concepts will be explained in the paper and questions will be asked on the context of it.</li>
                <li>Pre-requisite knowledge of the concepts is encouraged for inquisitiveness, but not mandatory. Students are expected to grasp concepts fast in a limited time.</li>
                <li>The concepts chosen according to us are basic and important for the youngsters to comprehend.</li>
                <li>Meritorious students will receive acknowledgement from Technothlon, IIT Guwahati.</li>
                <li>The performance in this exam will not affect your chances of getting selected to participate in Technothlon Mains in the campus, since it is an independent exam.</li>
            </ol>
            </p>
        </div>
    </div>
    <script src="{{ asset('js/jquery.slides.js') }}"></script>
    <script>
        $(function() {
            $('#slides').slidesjs({
                        width: 800,
                        height: 600
                    }
            );
        });
        $(document).ready(function () {
            setTimeout(function(){$('a.slidesjs-play').click(); $('#slides').animate({height: '100%'}, 1000)}, 5000);

        });
    </script>
@endsection