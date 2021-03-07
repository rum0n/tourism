@extends('layouts.app')


@section('title','Recent Bookings')


@push('css')

@endpush


@section('banner')


@endsection

@section('content')


    <div class="Guides Guides-Loaded">
        <div class="ng-isolate-scope">

            <div class="Guides-grid Guides-ShowPrice">

                <section class="Intro-guides ng-scope ng-isolate-scope">

                    <!--.recentBookings.list-->
                    <div class="ng-scope">

                        @if(count($recent_bookings)!=0)
                            <h2 class="ng-scope" style="margin-top: 10px">Recent bookings</h2>
                        @endif

                        <div class="Intro-grid Intro-ShowPrice" id="bookings">

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

                        <div class="Guides-loadMore ng-scope">

                            @if(count($recent_bookings) > 6)
                            <button id="show-more" class="Button Button--fullWidth Button--inverted Button--orange Button--invertedAlternativeHover" data-page="2" data-last="{{$recent_bookings->lastPage()}}" data-link="http://localhost:8000/bookings?page=" data-div="#bookings">Show more</button>
                            @endif

                            <span class="paginate_design">{{$recent_bookings->links()}}</span>
                        </div>

                        <div class="Guides-loadMore ng-scope" id="loading">
                            <img class="loading-gif" src="{{asset('img/gal-pinner.gif')}}">
                        </div>

                        {{--<div class="Intro-moreButton ng-scope" >--}}
                            {{--<a href="{{ route('bookings') }}" class="Button Button--inverted Button--orange Button--invertedAlternativeHover" >View all</a>--}}
                        {{--</div>--}}
                        <!-- end recentBookings.hasMore -->

                    </div><!-- .recentBookings.list-->
                </section><!-- end ngIf: ctrl.guides.guideCount -->

            </div>
        </div>
    </div>

    @endsection


    @push('js')


    <!-- ============Show more Button for bookings =============== -->
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

                $html = $(response).find("#bookings").html();
                $div.append($html);

                $("#show-more").show();

                if ($last_page == parseInt($page)){
                    $("#show-more").hide();
                }
            });

            $(this).data('page', (parseInt($page) + 1)); //update page #

        });
    </script>
    <!-- ============end Show more Button  for bookings=============== -->



    @endpush