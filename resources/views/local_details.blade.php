@extends('layouts.app')


@section('title',$local->name.' from '.$local->location )


@push('css')
<style>
    .rating {
        display: flex;
        flex-direction: row-reverse;
        justify-content: start;
    }

    .rating>input {
        display: none
    }

    .rating>label {
        position: relative;
        width: 1em;
        font-size: 5vw;
        color: #FFD600;
        cursor: pointer
    }

    .rating>label::before {
        content: "\2605";
        position: absolute;
        opacity: 0
    }

    .rating>label:hover:before,
    .rating>label:hover~label:before {
        opacity: 1 !important
    }

    .rating>input:checked~label:before {
        opacity: 1
    }

    .rating:hover>input:checked~label:before {
        opacity: 0.4
    }

    .btn_review {
        background: #03a9f4;
        border: #03a9f4;
        margin-top: 14px;
    }

    .btn_report {

        margin-top: 14px;
    }

    .review {
        display: flex;
        flex-direction: row-reverse;
        justify-content: start;
    }

    .review button {
        float: right;
    }

    @media only screen and (max-width: 600px) {
        h1 {
            font-size: 14px
        }

        p {
            font-size: 12px
        }
    }
</style>
@endpush


@section('banner')

@endsection


@section('content')
<div class="GuideProfile">
    <div class="GuideProfile-header lazyloaded" style="background-image: url(/img/profile_background.jpg);">

        <div class="GuideProfile-header-overlay"></div>

        <div class="GuideProfile-header-content">
            <div class="GuideProfile-container">
                <div class="GuideProfile-content">
                    <div class="GuideProfile-namecard">
                        <p class="GuideProfile-name">
                            <span class="ng-binding">{{ $local->name }}</span>
                        </p>

                        <p class="GuideProfile-location">
                            {{str_limit($local->location,55) }}
                        </p>
                    </div>

                    <div class="GuideProfile-priceWrapper ng-scope">
                        <span class="GuideProfile-price ng-binding">
                        @if($local->price == 0)
                            Free
                        @else
                        <sup>$</sup><strong>{{$local->price}}</strong>/h
                        @endif
                        </span>

                    </div>

                    <div class="GuideMotto ReplyRate">
                        <div class="GuideMotto-content">
                            <span class="GuideMotto-quote GuideMotto-quote--left"><i class="fa fa-quote-left"></i></span>
                            <p class="ng-binding ng-isolate-scope">{{ $local->motto }}</p>
                            <span class="GuideMotto-quote GuideMotto-quote--right"><i class="fa fa-quote-right"></i></span>
                        </div>
                    </div>

                    <div class="GuideProfile-carousel">
                        {{--<img class="ng-scope ng-isolate-scope" src="{{ asset('/',$local->motto) }}" >--}}
                        <img class="ng-scope ng-isolate-scope" src="{{ asset('profile/picture/'.Auth::user()->pro_pic) }}" >
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="GuideProfile-container">
        <div class="GuideProfile-content">
            <div class="GuideProfile-actions ng-scope">
                <div class="GuideProfile-actions-reviewCount">
                    <p class="Rating--large Rating ng-isolate-scope">

                        <?php
                            $reviews = \App\Review::where('profile_id',$local->id)->get();
                            $rating = round($reviews->avg('rating'));
                        ?>

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
                        @else
                            <i class="fa fa-star ng-scope is-highlighted"></i>
                            <i class="fa fa-star ng-scope is-highlighted"></i>
                            <i class="fa fa-star ng-scope is-highlighted"></i>
                            <i class="fa fa-star ng-scope is-highlighted"></i>
                            <i class="fa fa-star ng-scope is-highlighted"></i>
                        @endif

                    </p>
                    <p class="ng-binding ng-scope">Reviews : <strong class="ng-binding">{{count($reviews)}}</strong></p>

                </div>
                <div class="GuideProfile-actions-content">
                    <div>
                        <div class="GuideProfile-actions-buttons ng-scope ng-isolate-scope">
                            @auth
                            @if($local->id == Auth::user()->id)

                                @if(Auth::user()->role_id == 2)
                                    <a href="{{ route('guide.edit.profile',Auth::user()->id) }}" class="Button Button--blue Button--fullWidth Button--large-tablet">
                                        Edit profile
                                    </a>
                                @elseif(Auth::user()->role_id == 3)
                                    <a href="{{ route('user.edit.profile',Auth::user()->id) }}" class="Button Button--blue Button--fullWidth Button--large-tablet">
                                        Edit profile
                                    </a>
                                @endif

                            @else
                                @if(Auth::user()->role_id == 3)
                                    <div class="GuideProfile-actions-button GuideProfile-actions-button--wide GuideProfile-actions-button-double ng-scope">
                                        <div class="GuideProfile-actions-button-label">
                                            Create a trip with <strong class="ng-binding">{{ $local->name }}</strong>
                                        </div>

                                        <a href="{{ route('user.create_trip',$local->id) }}" class="Button Button--blue Button--fullWidth Button--large-tablet">
                                            Create a Trip
                                        </a>
                                    </div>
                                @endif
                            @endif
                            @endauth

                        </div>

                    </div><!-- end ngIf: ctrl.shareAvailable -->
                </div>
            </div>
        </div><!-- end ngIf: ctrl.areButtonsVisible -->
    </div>
</div>

<div class="GuideProfile-container">
    <div class="GuideProfile-content">
        <div class="GuideProfile-info">
            <div class="GuideProfile-info-row GuideProfile-heading ng-scope">
                @if($local->id == Auth::user()->id)
                    <h1 class="ng-binding">{{str_limit($local->location,50) }}</h1></div>
                @else
                    <h1 class="ng-binding">Explore {{str_limit($local->location,50) }} with {{$local->name}}</h1></div>
                @endif


            <div class="GuideProfile-info-row ng-scope">
                <div class="col-md-4-7">
                    <h2>Email</h2>
                </div>
                <div class="col-md-7-3">
                    <div>
                        <p class="Overflow-expandableText ng-binding">{{ $local->email }}</p>
                    </div>
                </div>
            </div>

            <div class="GuideProfile-info-row ng-scope">
                <div class="col-md-4-7">
                    <h2>Phone</h2>
                </div>
                <div class="col-md-7-3">
                    <div>
                        <p class="Overflow-expandableText ng-binding">{{ $local->phone }}</p>
                    </div>
                </div>
            </div>

            <div class="GuideProfile-info-row ng-scope">
                <div class="col-md-4-7">
                    <h2>About me</h2>
                </div>
                <div class="col-md-7-3">
                    <div>
                        <p class="Overflow-expandableText ng-binding">{{ $local->about }}</p>
                    </div>
                </div>
            </div>

            {{--<div class="GuideProfile-info-row ng-scope">--}}
                {{--<div class="col-md-4-7">--}}
                    {{--<h2>Activities</h2>--}}
                {{--</div>--}}
                {{--<div class="col-md-7-3">--}}
                    {{--<div class="GuideActivities ng-isolate-scope">--}}
                        {{--<div class="GuideActivities-activity">--}}
                            {{--<span>Translation & Interpretation</span>--}}
                        {{--</div>--}}
                    {{--</div>--}}
                {{--</div>--}}
            {{--</div>--}}

        </div>
    </div>
</div>

<section class="GuideProfile-reviews">
    <div class="GuideProfile-container">

        @auth
        @if($local->id != Auth::user()->id && Auth::user()->role_id != 1)

        <!--Report form-->
        <br>
        <div class="" style="float: left">
            <button class="btn btn-primary" id="review">Rate this guide</button>
            <button class="btn btn-warning" id="report">Report to admin</button>
        </div><br><br><br><br>

        <div class="report" style="display: none" id="report-form">
            <form method="post" action="{{ route('report_user',$local->id) }}">
                @csrf
                <label for="report">Write your Complain to admin about {{ $local->name }}</label>
                <textarea class="form-control" type="text" name="report" id="report" placeholder="Write your complain about {{$local->name}}"></textarea>
                <button class="btn btn-danger btn_report" type="submit">Submit Report</button>
            </form>
        </div><!--End report form-->


        <!--Review form-->
        <div class="review" style="display: none" id="review-form">
            {{--<h1>Star rating </h1>--}}
            <form method="post" action="{{ route('add_review',$local->id) }}">
                @csrf
                <label>Give your ratings about {{ $local->name }}</label>
                <div class="rating">
                    <input type="radio" name="rating" value="5" id="5">
                    <label for="5" title="Excellent">☆</label>
                    <input type="radio" name="rating" value="4" id="4">
                    <label for="4" title="Good">☆</label>
                    <input type="radio" name="rating" value="3" id="3">
                    <label for="3" title="Ok">☆</label>
                    <input type="radio" name="rating" value="2" id="2">
                    <label for="2" title="Poor">☆</label>
                    <input type="radio" name="rating" value="1" id="1">
                    <label for="1" title="Very bad">☆</label>
                </div>
                <textarea class="form-control" type="text" name="review" id="review" placeholder="Say Something About {{$local->name}}"></textarea>

                <button class="btn btn-info btn_review" type="submit">Submit Review</button>
            </form>
        </div><!--End review form-->
        @endif
        @endauth


        <div class="Reviews-count" style="margin-bottom: 3px">
            {{count($reviews)}} Review(s)
        </div>

        <div class="ng-scope">
            @foreach($reviews as $review)
            <div class="Reviews-list">
                <div class="GuideProfile-content">

                    <div class="Review row">

                        <div class="Review-details col-md-4-7">
                            <a href="#">
                                <img src="/img/profile1.jpg">
                            </a>
                            <div class="Review-detailContentWrapper">
                                <p class="Review-name">
						        <span>
						          <a href="#"><strong class="ng-binding">{{$review->user->name}}</strong></a>
						          <span class="Review-type ng-binding">as a {{$review->user->role->name}}</span>
						        </span>
                                </p>
                                <p class="Review-date ng-binding">{{ $review->created_at->diffForHumans()}}</p>
                            </div>
                        </div>

                        <div class="Review-content col-md-7-3">
                            <p class="Review-text ng-binding ng-scope">
                                {{$review->review}}</p>

                            <p class="Rating--small Rating">

                                @if($review->rating == 1)
                                    <i class="fa fa-star ng-scope is-highlighted"></i>
                                    <i class="fa fa-star ng-scope"></i>
                                    <i class="fa fa-star ng-scope"></i>
                                    <i class="fa fa-star ng-scope"></i>
                                    <i class="fa fa-star ng-scope"></i>

                                @elseif($review->rating == 2)
                                    <i class="fa fa-star ng-scope is-highlighted"></i>
                                    <i class="fa fa-star ng-scope is-highlighted"></i>
                                    <i class="fa fa-star ng-scope"></i>
                                    <i class="fa fa-star ng-scope"></i>
                                    <i class="fa fa-star ng-scope"></i>
                                @elseif($review->rating == 3)
                                    <i class="fa fa-star ng-scope is-highlighted"></i>
                                    <i class="fa fa-star ng-scope is-highlighted"></i>
                                    <i class="fa fa-star ng-scope is-highlighted"></i>
                                    <i class="fa fa-star ng-scope"></i>
                                    <i class="fa fa-star ng-scope"></i>
                                @elseif($review->rating == 4)
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

            @endforeach
        </div>
    </div>
</section>


@endsection


@push('js')

    <!-- ============Report =============== -->
    <script>

        $("#report").click(function() {
            $("#report").hide();
            $("#review").show();
            $("#report-form").show();
            $("#review-form").hide();
        });
    </script>
    <!-- ============end report =============== -->

    <!-- ============Review =============== -->
    <script>

        $("#review").click(function() {
            $("#review").hide();
            $("#report").show();
            $("#report-form").hide();
            $("#review-form").show();
        });
    </script>
    <!-- ============end review =============== -->

@endpush