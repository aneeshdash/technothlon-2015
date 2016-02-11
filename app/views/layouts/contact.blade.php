@extends('layouts.master')
@section('title')
Contact Us
@endsection
@section('head')
<link rel="stylesheet" type="text/css" href="{{ asset('sprites/contact.css') }}">
@endsection
@section('description')
Contact Us
@endsection
@section('body')
<div class="container">
    <div class="sprite-contact contact-logo logo"></div>
    <div class="sprite-contact contact-title title" style="margin-bottom:14px"></div>

    <h1 style="text-align: center">Mail Us</h1>

    <div class="in-container" style="text-align: center">
        <a class="fade" href="mailto:technothlon@techniche.org" target="_blank">
            <div class="sprite-contact mail"></div>
        </a>
        <br>
        <a href="mailto:technothlon@techniche.org" target="_blank">
            technothlon@techniche.org
        </a>
    </div>

    <h1 style="text-align: center">Get social with us</h1>

    <div class="in-container" style="text-align: center">
        <div style="display: table; width: 800px; text-align: center">
            <div style="display: table-row">
                <div style="display:table-cell; text-align: center">
                    <a class="fade" href="https://www.facebook.com/technothlon.techniche" target="_blank">
                        <div class="sprite-contact facebook"></div>
                    </a>
                </div>
                <div style="display:table-cell; text-align: center">
                    <a class="fade" href="https://www.google.com/+technothlon" target="_blank">
                        <div class="sprite-contact gplus"></div>
                    </a>
                </div>
                <div style="display:table-cell; text-align: center">
                    <a class="fade" href="http://technothlon.tumblr.com" target="_blank">
                        <div class="sprite-contact tumblr"></div>
                    </a>
                </div>
            </div>
        </div>
    </div>
    <br>
</div>
<div class="container">
    <h1 style="text-align: center">Organizing team</h1>
    <div class="in-container" id="contacts" style="text-align: center">
        <div class="person">
            <div class="regional-head">
                <div>
                    <div class="regional-head-text sprite-contact region west"></div>
                    <div class="regional-head-text">West Region</div>
                </div>
            </div>
            <div class="name">
                <div class="sprite-contact boy"></div>
                <div class="inline-block">
                    <a href="https://www.facebook.com/gameroller" target="_blank">Piyush Rai</a>
                </div>
            </div>
            <div class="phone-number">
                <div class="sprite-contact phone"></div>
                <div class="inline-block"><a href="tel:+919085292420">+91 90 85 292420</a></div>
            </div>
            <div class="person-mail">
                <div class="sprite-contact email"></div>
                <div class="inline-block">
                    <a href="mailto:piyush@technothlon.techniche.org">piyush@technothlon.techniche.org</a>
                </div>
            </div>
        </div>
        <div class="person">
            <div class="regional-head">
                <div>
                    <div class="regional-head-text sprite-contact region east"></div>
                    <div class="regional-head-text">East Region</div>
                </div>
            </div>
            <div class="name">
                <div class="sprite-contact boy"></div>
                <div class="inline-block">
                    <a href="https://www.facebook.com/abhishek.chatterjee.902819" target="_blank">Abhishek Chatterjee</a>
                </div>
            </div>
            <div class="phone-number">
                <div class="sprite-contact phone"></div>
                <div class="inline-block"><a href="tel:+919085285575">+91 90 85 285575</a></div>
            </div>
            <div class="person-mail">
                <div class="sprite-contact email"></div>
                <div class="inline-block">
                    <a href="mailto:abhishek@technothlon.techniche.org">abhishek@technothlon.techniche.org</a>
                </div>
            </div>
        </div>
        <div class="person">
            <div class="regional-head">
                <div>
                    <div class="regional-head-text sprite-contact central"></div>
                    <div class="regional-head-text">Central Region</div>
                </div>
            </div>
            <div class="name">
                <div class="sprite-contact girl"></div>
                <div class="inline-block">
                    <a href="https://www.facebook.com/vasavi.madhurima.5" target="_blank">B. Vasavi Madhurima</a>
                </div>
            </div>
            <div class="phone-number">
                <div class="sprite-contact phone"></div>
                <div class="inline-block"><a href="tel:+918011027835">+91 80 11 027835</a></div>
            </div>
            <div class="person-mail">
                <div class="sprite-contact email"></div>
                <div class="inline-block"><a
                        href="mailto:vasavi@technothlon.techniche.org">vasavi@technothlon.techniche.org</a>
                </div>
            </div>
        </div>
        <div class="person">
            <div class="regional-head">
                <div>
                    <div class="regional-head-text sprite-contact region"></div>
                    <div class="regional-head-text">North Region</div>
                </div>
            </div>
            <div class="name">
                <div class="sprite-contact boy"></div>
                <div class="inline-block">
                    <a href="https://www.facebook.com/aneeshdash" target="_blank">Aneesh Dash</a>
                </div>
            </div>
            <div class="phone-number">
                <div class="sprite-contact phone"></div>
                <div class="inline-block"><a href="tel:+918011036096">+91 80 11 036096</a></div>
            </div>
            <div class="person-mail">
                <div class="sprite-contact email"></div>
                <div class="inline-block"><a
                        href="mailto:aneesh@technothlon.techniche.org">aneesh@technothlon.techniche.org</a>
                </div>
            </div>
        </div>
        <div class="person">
            <div class="regional-head">
                <div>
                    <div class="regional-head-text sprite-contact region south"></div>
                    <div class="regional-head-text">South Region</div>
                </div>
            </div>
            <div class="name">
                <div class="sprite-contact boy"></div>
                <div class="inline-block">
                    <a href="https://www.facebook.com/revanth.reva" target="_blank">Revanth Chetluru</a>
                </div>
            </div>
            <div class="phone-number">
                <div class="sprite-contact phone"></div>
                <div class="inline-block"><a href="tel:+918011022208">+91 80 11 022208</a></div>
            </div>
            <div class="person-mail">
                <div class="sprite-contact email"></div>
                <div class="inline-block"><a
                        href="mailto:revanth@technothlon.techniche.org">revanth@technothlon.techniche.org</a>
                </div>
            </div>
        </div>
        <div class="person">
            <div class="regional-head">
                <div>
                    <div class="regional-head-text sprite-contact region south"></div>
                    <div class="regional-head-text">South Region</div>
                </div>
            </div>
            <div class="name">
                <div class="sprite-contact boy"></div>
                <div class="inline-block">
                    <a href="https://www.facebook.com/ajay.narasimha.50" target="_blank">Ajay Narasimha</a>
                </div>
            </div>
            <div class="phone-number">
                <div class="sprite-contact phone"></div>
                <div class="inline-block"><a href="tel:+918011026146">+91 80 11 026146</a></div>
            </div>
            <div class="person-mail">
                <div class="sprite-contact email"></div>
                <div class="inline-block">
                    <a href="mailto:ajay@technothlon.techniche.org">ajay@technothlon.techniche.org</a>
                </div>
            </div>
        </div>
    </div>
    </div>
        @endsection