@extends('layouts.app')


@section('title','Find Local Guides')


@push('css')

@endpush

@section('banner')

    <div class="Guides-header" style="background-image: url(&quot;//showaroundoriginal.imgix.net/places/ChIJOwg_06VPwokRYv534QaPC8gxvzsb.jpg?w=1400&amp;h=560&amp;dpr=1&amp;q=60&quot;);">
        <div class="Guides-header-overlay"></div>

        <div class="Guides-header-content">
            <div class="Container">

                <form method="get" action="{{ route('find_local') }}">
                    @csrf
                    <div class="align-content-center">
                        <div class="SearchField ng-pristine ng-pending">
                                <span class="SearchField-icon">
                                    <i class="fa fa-search"></i>
                                </span>
                            <input type="text" name="location" id="location" placeholder="Where next?" value="{{ $search_location }}">
                        </div>

                            <span class="SearchField searchDate" style="margin-top: 20px">
                                <span class="SearchField-icon">
                                    <i class="fa fa-calendar calendarIcon"></i>
                                </span>

                                <input class="searchDate" id="pickdate" name="date" autocomplete="off" value="{{ $search_date }}">

                            </span>
                        <div class="btns1">
                            <button class="SearchField-button" type="submit">
                                <span>BROWSE LOCALS</span>
                            </button>
                        </div>

                    </div>


                </form>

            </div>
        </div>
    </div>

@endsection


@section('content')


    <div class="Guides Guides-Loaded">
        <div class="ng-isolate-scope">

            @if(count($local_guides)!=0)
            <div class="ng-scope">
                <h3 class="Guides-count">
                    <span class="ng-binding ng-scope">Explore <strong>{{ $search_location }}</strong> with one of <strong>{{ count($local_guides) }}</strong> locals</span>
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
                                                        <hr><strong class="ng-binding ng-scope">1</strong>
                                                    </div>
                                                </div>

                                                <div class="Guide-stat">
                                                    <p class="Guide-stat-label">Rating</p>
                                                    <p class="Guide-stat-value Rating--small Rating ng-isolate-scope">
                                                        <i class="fa fa-star ng-scope is-highlighted"></i>
                                                        <i class="fa fa-star ng-scope is-highlighted"></i>
                                                        <i class="fa fa-star ng-scope is-highlighted"></i>
                                                        <i class="fa fa-star ng-scope is-highlighted"></i>
                                                        <i class="fa fa-star ng-scope is-highlighted"></i>
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

                        {{--@if($local_guides->currentPage() != $local_guides->lastPage())--}}
                        {{--<button id="show-more" class="Button Button--fullWidth Button--inverted Button--orange Button--invertedAlternativeHover" data-page="2" data-last="{{$local_guides->lastPage()}}" data-link="http://localhost:8000/find/locals?page=" data-div="#locals">Show more</button>--}}
                        {{--@endif--}}
                        {{--<span class="paginate_desig">{{$local_guides->links()}}</span>--}}
                    </div>

                    {{--<div class="Guides-loadMore ng-scope" id="loading">--}}
                        {{--<img class="loading-gif" src="{{asset('img/gal-pinner.gif')}}">--}}
                    {{--</div>--}}
                </div>

            </div>
             @else
                <div class="ng-scope">
                    <h3 class="Guides-count">
                        <span class="ng-binding ng-scope" style="color: red">Sorry ! No Locals Found</span>
                    </h3>
                </div>
            @endif

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
    <!-- ============End of date Picker =============== -->

    <!--------Js for google map---------->
    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBYG5g2aJ9TjMlbYk7E_VuFYKSvHC1Ee6Y&libraries=places" type="text/javascript"></script>
    <script>
        var searchBox = new google.maps.places.SearchBox(document.getElementById('location'));
    </script>


@endpush