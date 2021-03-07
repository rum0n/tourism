<!DOCTYPE html>
<html class="">
<head lang="en">
    <meta http-equiv="content-type" content="text/html; charset=UTF-8">

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width,initial-scale=1,maximum-scale=1,user-scalable=no">

    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title')</title>

    <link rel="apple-touch-icon" sizes="180x180" href="#apple-touch-icon.png">
    <link id="favicon-32" rel="icon" type="image/png" href="#favicon-32x32.png" sizes="32x32">
    <link id="favicon-16" rel="icon" type="image/png" href="#favicon-16x16.png" sizes="16x16">

    <link rel="stylesheet" type="text/css" href="{{ asset('assets') }}/bootstrap.min.css"/>

    <!-- ================For Datepicker=============== -->
    <link rel="stylesheet" href="{{ asset('assets/css') }}/jquery-ui.css">


    <link rel="stylesheet" href="{{ asset('assets/css') }}/toastr.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="{{ asset('assets/css') }}/app.css">
    <link rel="stylesheet" href="{{ asset('assets/css') }}/custom.css">

    @stack('css')


</head>
<body class="is-hoverEnabled with-hiddenNavigationTablet" style="min-height: 750px">

<div class="Wrapper">

    <!-- Navbar -->
        @include('layouts.header')
    <!-- /.navbar -->

    <section class="Content ng-scope">
        <div class="ng-scope">
            <div class="Intro ng-scope ng-isolate-scope">
                <!-- banner-->
                @yield('banner')
                <!-- banner-->

                <!-- content-->
                @yield('content')
                <!-- content-->

            </div>
        </div>
    </section>

    <!-- footer -->
    @include('layouts.footer')
    <!-- /.footer -->

</div>

<div id="fb-root"></div>




<ul class="AutocompletePredictions ng-scope ng-isolate-scope"  style="background: white none repeat scroll 0% 0%; display: none; position: absolute; z-index: 2000;">
    <!-- ngRepeat: prediction in ctrl.predictions -->
</ul><ul class="AutocompletePredictions ng-scope ng-isolate-scope" ng-style="css" predictions="predictions" input="element" selected-prediction="selectedPrediction" style="background: white none repeat scroll 0% 0%; display: none; position: absolute; z-index: 2000;">
    <!-- ngRepeat: prediction in ctrl.predictions -->
</ul>


<script src="{{asset('assets/js')}}/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
<script src="{{asset('assets/js')}}/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
<script src="{{asset('assets/js')}}/bootstrap-v4.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>

<!-- jQuery -->
<script src="{{asset('admin/plugins')}}/jquery/jquery.min.js"></script>
<!-- jQuery UI 1.11.4 -->

<script src="{{asset('assets/js')}}/sweetalert2.all.js"></script>
<script src="{{asset('assets/js')}}/toastr.min.js"></script>
{!! Toastr::message() !!}

<script>
    @if($errors->any())
        @foreach($errors->all() as $error)
              toastr.error('{{ $error }}','Error',{
        closeButton:true,
        progressBar:true,
    });
    @endforeach
    @endif
</script>


<script>

    $('.Navigation-mobileMenu').on('click', function () {
        $(".Navigation").hide()
        $(".MobileNavigation").show()

    });


    $('.MobileNavigation-close').on('click', function () {
        $(".MobileNavigation").hide()
        $(".Navigation").show()

    });

    $('#nav1').hover(function(){
        $('#bar').toggleClass('show');
    });

</script>


<!-- =====================For date Picker======================== -->

<script src="{{asset('assets/js')}}/jquery.min.js"></script>
<script src="{{asset('assets/js')}}/jquery-ui.min.js"></script>


@stack('js')

</body>
</html>