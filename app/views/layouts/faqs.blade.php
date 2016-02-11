@extends('layouts.master')
@section('title')
    Technothlon | FAQs
@endsection
@section('head')
<link rel="stylesheet" type="text/css" href="{{ asset('sprites/faqs.css') }}">
@endsection
@section('description')
Frequently Asked Questions
@endsection
@section('body')
<div class="container">
            <div class="sprite-faqs faq-logo logo"></div>
            <div class="sprite-faqs faqs-title title"></div>
            <div class="in-container">
                <?php
                $faqs=DB::table('faqs')->Orderby('priority')->get();
                foreach($faqs as $faq) {
                    echo '<div class="faq"><div class="question">'.$faq->question.' ?</div><div class="answer">'.$faq->answer.'</div></div>';
                }
                    ?>
            <br>
        </div>
<script>
            $(document).ready(function () {
            $(".question").on("click", function (a) {
            var $ele = $(this).parent().find(".answer");
            if ($ele.is(':visible')) {
                        $(this).removeClass('active');
                        $ele.slideUp()
                    } else {
                        $(this).addClass('active');
                        $ele.slideDown();
                    }
                })
            });
</script>
    @endsection