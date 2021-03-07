@extends('layouts.app')


@section('title','Find Your Local Tour Guide')


@push('css')

@endpush


@section('banner')

    <section class="Intro-header Intro-header--howItWorks ng-isolate-scope"  style="background-image: url(&quot;https://showaroundoriginal.imgix.net/places/ChIJD7fiBh9u5kcRYJSMaMOCCwQknitr.jpg?w=1400&amp;dpr=1&amp;or=0&amp;bri=0&amp;con=0&amp;q=0&quot;);">

        <div class="Intro-header-overlay"></div>

        <div class="Intro-header-content">
            <center>
                <div class="Intro-header-container">

                    <!-- ngIf: !ctrl.userModel.item.id --><div class="Intro-header-buttons ng-scope">
                        <button class="Intro-header-button Button Button--white Button--inverted Button--invertedAlternativeHover">Connect</button>

                        <a class="Intro-header-button Button Button--orange" sa-become-guide-button="" href="#become-a-local">Sign Up As a Local</a>
                    </div><!-- end ngIf: !ctrl.userModel.item.id -->

                    <img src="" class="Intro-logo" alt=" ">
                    <div class="Intro-slogan">
                        <p><strong>Find a Local</strong></p>
                        <p>to show you around</p>
                    </div>

                    {{--<span>--}}
                    <form method="get" action="{{ route('find_local') }}">
                        @csrf
                        <div class="align-content-center">

                            <div class="SearchField ng-pristine ng-pending">
                                <span class="SearchField-icon">
                                    <i class="fa fa-search"></i>
                                </span>
                                <input type="text" name="location" id="location" placeholder="Where next?">
                            </div>

                            <span class="SearchField searchDate" style="margin-top: 20px">
                                <span class="SearchField-icon">
                                    <i class="fa fa-calendar calendarIcon"></i>
                                </span>

                                <input class="searchDate" id="pickdate" name="date" placeholder="Select date" autocomplete="off">

                            </span>
                            <div class="btns">
                                <button class="SearchField-button" type="submit">
                                    <span>BROWSE LOCALS</span>
                                </button>
                            </div>

                        </div>

                    </form>
                    {{--</span>--}}


                </div>
            </center>
        </div>

    </section>

@endsection

@section('content')


    <div class="Guides Guides-Loaded">
        <div class="ng-isolate-scope">

            <div class="ng-scope">
                <h3 class="Guides-count">
                    <span class="ng-binding ng-scope">Find your local tour guide</span>
                </h3>
            </div>

            <div class="Guides-grid Guides-ShowPrice">

                <div class="ng-scope">


                    <div class="row" id="locals">
                        @foreach($local_guides as $local)
                        <div class="col-md-6">

                            <div class="Guides-column">
                                <a class="Guide" href="{{ route('local',$local->id) }}">
                                    <div class="Guide-photo">
                                        <img size="large" class="ng-isolate-scope lazyloaded" src="{{ asset('img/demo.jpg') }}">
                                        <div class="Guide-photo-gradient"></div>
                                    </div>

                                    <div class="Guide-details">
                                        <div class="Guide-namecard">
                                            <p class="Guide-name ng-binding">{{ $local->name }}</p>
                                            <p class="Guide-location ng-binding">
                                                <span class="Guide-location-marker">
                                                  <i class="fa fa-marker"></i>&nbsp;
                                                </span>
                                                {{ $local->location }}
                                            </p>
                                            <span class="Guide-price ng-binding">
                                                @if($local->price == 0)
                                                    Free
                                                @else
                                                    <strong><sup>$</sup>{{$local->price}}</strong>/h
                                                @endif
                                            </span>
                                        </div>

                                        <div class="Guide-motto">
                                            <span class="Guide-motto-quote Guide-motto-quote--left"><i class="fa fa-quote-left"></i></span>
                                            <span class="Guide-motto-quote Guide-motto-quote--right"><i class="fa fa-quote-right"></i></span>
                                            <div class="Guide-motto-content" sa-ellipsis-container="">
                                                <p sa-ellipsis="" ng-bind="::$ctrl.guide.shortDescription" class="ng-binding ng-isolate-scope">{{ $local->motto }}</p>
                                            </div>
                                        </div>

                                        <div class="Guide-stats">
                                            <div class="Guide-stat">
                                                <p class="Guide-stat-label">Reviews</p>
                                                <div class="Guide-stat-value">
                                                    <?php
                                                        $reviews = \App\Review::where('profile_id',$local->id)->get();
                                                        $rating = round($reviews->avg('rating'));
                                                    ?>
                                                    <hr><strong class="ng-binding ng-scope">{{count($reviews)}}</strong>
                                                </div>
                                            </div>

                                            <div class="Guide-stat">
                                                <p class="Guide-stat-label">Rating</p>
                                                <p class="Guide-stat-value Rating--small Rating ng-isolate-scope">

                                                    @if($rating==0)
                                                        <i class="fa fa-star ng-scope"></i>
                                                        <i class="fa fa-star ng-scope"></i>
                                                        <i class="fa fa-star ng-scope"></i>
                                                        <i class="fa fa-star ng-scope"></i>
                                                        <i class="fa fa-star ng-scope"></i>
                                                    @elseif($rating==1)
                                                        <i class="fa fa-star ng-scope is-highlighted"></i>
                                                        <i class="fa fa-star ng-scope"></i>
                                                        <i class="fa fa-star ng-scope"></i>
                                                        <i class="fa fa-star ng-scope"></i>
                                                        <i class="fa fa-star ng-scope"></i>
                                                    @elseif($rating==2)
                                                        <i class="fa fa-star ng-scope is-highlighted"></i>
                                                        <i class="fa fa-star ng-scope is-highlighted"></i>
                                                        <i class="fa fa-star ng-scope"></i>
                                                        <i class="fa fa-star ng-scope"></i>
                                                        <i class="fa fa-star ng-scope"></i>
                                                    @elseif($rating==3)
                                                        <i class="fa fa-star ng-scope is-highlighted"></i>
                                                        <i class="fa fa-star ng-scope is-highlighted"></i>
                                                        <i class="fa fa-star ng-scope is-highlighted"></i>
                                                        <i class="fa fa-star ng-scope"></i>
                                                        <i class="fa fa-star ng-scope"></i>
                                                    @elseif($rating==4)
                                                        <i class="fa fa-star ng-scope is-highlighted"></i>
                                                        <i class="fa fa-star ng-scope is-highlighted"></i>
                                                        <i class="fa fa-star ng-scope is-highlighted"></i>
                                                        <i class="fa fa-star ng-scope is-highlighted"></i>
                                                        <i class="fa fa-star ng-scope"></i>
                                                    @elseif($rating==5)
                                                        <i class="fa fa-star ng-scope is-highlighted"></i>
                                                        <i class="fa fa-star ng-scope is-highlighted"></i>
                                                        <i class="fa fa-star ng-scope is-highlighted"></i>
                                                        <i class="fa fa-star ng-scope is-highlighted"></i>
                                                        <i class="fa fa-star ng-scope is-highlighted"></i>
                                                    @endif
                                                </p>
                                            </div>
                                        </div>
                                    </div>
                                </a>
                            </div>

                        </div>
                        @endforeach
                    </div>

                    <div class="Guides-loadMore ng-scope">
                        @if(count($local_guides) > 4)
                        <button id="show-more" class="Button Button--fullWidth Button--inverted Button--orange Button--invertedAlternativeHover" data-page="2" data-last="{{$local_guides->lastPage()}}" data-link="http://localhost:8000/?page=" data-div="#locals">Show more</button>
                        @endif
                        <span class="paginate_design">{{$local_guides->links()}}</span>
                    </div>

                    <div class="Guides-loadMore ng-scope" id="loading">
                        <img class="loading-gif" src="{{asset('img/gal-pinner.gif')}}">
                    </div>


                </div>

                <section class="Intro-guides ng-scope ng-isolate-scope">

                    <!--.recentBookings.list-->
                    <div class="ng-scope">

                        @if(count($recent_bookings)!=0)
                        <h2 class="ng-scope" style="margin-top: 10px">Recent bookings</h2>
                        @endif

                        <div class="Intro-grid Intro-ShowPrice" >
                            @foreach($recent_bookings as $booking)
                            <div class="Intro-column ng-scope">
                                <div class="RecentBooking">
                                    <span class="RecentBooking-price ng-binding"><strong><sup>$</sup>{{ \App\User::find($booking->local_id)->price }}</strong>/h</span>

                                    <?php
                                        $guide = \App\User::find($booking->local_id);
                                    ?>
                                    <a href="{{ route('local',$guide->id) }}"><div class="RecentBooking-content">

                                            {{--<div class="RecentBooking-city lazyload" style="background-image: image({{ asset('img/.jpg') }}})"></div>--}}

                                            <img class="RecentBooking-city lazyload" src="{{ asset('img/3.jpg') }}">

                                            <div class="RecentBooking-overlay">
                                                <img class="RecentBooking-photo" src="{{ asset('img/2.jpg') }}">
                                                <div class="RecentBooking-info">
                                                    <span class="u-boldText ng-binding">{{ \App\User::find($booking-> traveller_id)->name }}</span> booked a tour with
                                                    <span class="u-boldText ng-binding">{{ $guide->name }}</span>
                                                    <p>in <span class="RecentBooking-location ng-binding">{{ str_limit($booking->location,15) }}</span></p>
                                                </div>
                                            </div>
                                            <div class="Intro-bGradient"></div>
                                        </div></a>

                                    <?php
                                        $traveller=\App\User::find($booking->traveller_id);
                                        $reviews = \App\Review::where('profile_id',$booking->local_id)->get();
                                        $rating= round($reviews->avg('rating'));
                                    ?>

                                    <div class="RecentBooking-review">
                                        <a href="{{ route('local',$traveller->id)}}">
                                            <div class="RecentBooking-guest">
                                                <img size="mini" class="ng-isolate-scope lazyload" src="{{ asset('img/2.jpg') }}">
                                                <p class="ng-binding">{{ $traveller->name }}</p>
                                            </div>
                                        </a>
                                        <p class="RecentBooking-reviewContent ng-binding">
                                            {{$traveller->about}}
                                            {{--I’d rather say it short, it’s hard to make a friend from the first meeting, sound like i got one yesterday.--}}
                                            {{--I felt sad when the day has ended (really) I was hoping it wouldn't.--}}
                                            {{--Thank u Rania--}}
                                        </p>
                                        <div class="RecentBooking-rating">
                                            <p class="Rating--small Rating ng-isolate-scope" rating="booking.review.rating"><!-- ngRepeat: star in ::stars -->
                                                {{--@php $rating = \App\Review::where('profile_id',$booking->local_id)->get(); @endphp--}}
                                                <?php
                                                    $reviews = \App\Review::where('profile_id',$booking->local_id)->get();
                                                    $rating= round($reviews->avg('rating'));
                                                ?>
                                                @if($rating== 0)
                                                    <i class="fa fa-star ng-scope"></i>
                                                    <i class="fa fa-star ng-scope"></i>
                                                    <i class="fa fa-star ng-scope"></i>
                                                    <i class="fa fa-star ng-scope"></i>
                                                    <i class="fa fa-star ng-scope"></i>
                                                @elseif($rating==1)
                                                    <i class="fa fa-star ng-scope is-highlighted"></i>
                                                    <i class="fa fa-star ng-scope"></i>
                                                    <i class="fa fa-star ng-scope"></i>
                                                    <i class="fa fa-star ng-scope"></i>
                                                    <i class="fa fa-star ng-scope"></i>
                                                @elseif($rating==2)
                                                    <i class="fa fa-star ng-scope is-highlighted"></i>
                                                    <i class="fa fa-star ng-scope is-highlighted"></i>
                                                    <i class="fa fa-star ng-scope"></i>
                                                    <i class="fa fa-star ng-scope"></i>
                                                    <i class="fa fa-star ng-scope"></i>
                                                @elseif($rating==3)
                                                    <i class="fa fa-star ng-scope is-highlighted"></i>
                                                    <i class="fa fa-star ng-scope is-highlighted"></i>
                                                    <i class="fa fa-star ng-scope is-highlighted"></i>
                                                    <i class="fa fa-star ng-scope"></i>
                                                    <i class="fa fa-star ng-scope"></i>
                                                @elseif($rating==4)
                                                    <i class="fa fa-star ng-scope is-highlighted"></i>
                                                    <i class="fa fa-star ng-scope is-highlighted"></i>
                                                    <i class="fa fa-star ng-scope is-highlighted"></i>
                                                    <i class="fa fa-star ng-scope is-highlighted"></i>
                                                    <i class="fa fa-star ng-scope"></i>
                                                @else
                                                    <i class="fa fa-star ng-scope is-highlighted"></i>
                                                    <i class="fa fa-star ng-scope is-highlighted"></i>
                                                    <i class="fa fa-star ng-scope is-highlighted"></i>
                                                    <i class="fa fa-star ng-scope is-highlighted"></i>
                                                    <i class="fa fa-star ng-scope is-highlighted"></i>
                                                @endif
                                            </p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- end recentBookings.list -->
                            @endforeach
                        </div>

                        @if(count($recent_bookings) >3)
                        <div class="Intro-moreButton ng-scope" >
                            <a href="{{ route('bookings') }}" class="Button Button--inverted Button--orange Button--invertedAlternativeHover" >View all</a>
                        </div><!-- end recentBookings.hasMore -->
                        @endif
                    </div><!-- .recentBookings.list-->
                </section>
                <!-- end ngIf: ctrl.guides.guideCount -->

            </div>
        </div>
    </div>


@endsection


@push('js')

    <!-- ============For date Picker=============== -->
    <script>
        $(function() {
            $( "#pickdate" ).datepicker({
                dateFormat: 'dd MM yy',
                minDate: 0
            });

        });
    </script>


    <!-- ============Show more Button for local =============== -->
    <script>

        $("#show-more").click(function() {
            $("#show-more").hide();
            $("#loading").show();

            $div = $($(this).data('div')); //div to append
            $link = $(this).data('link'); //current URL
            $last_page = $(this).data('last'); //last page number


            $page = $(this).data('page'); //get the next page #
            $href = $link + $page; //complete URL

            $.get($href, function(response) { //append data

                $("#loading").hide();
//                $(".see-more").show();

                $html = $(response).find("#locals").html();
                $div.append($html);

                $("#show-more").show();

                if ($last_page == parseInt($page)){
                    $("#show-more").hide();
                }
            });

            $(this).data('page', (parseInt($page) + 1)); //update page #

        });
    </script>
    <!-- ============end Show more Button  for local=============== -->


    <!--------Js for google map---------->
    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBYG5g2aJ9TjMlbYk7E_VuFYKSvHC1Ee6Y&libraries=places" type="text/javascript"></script>
    <script>
        var searchBox = new google.maps.places.SearchBox(document.getElementById('location'));
    </script>

@endpush