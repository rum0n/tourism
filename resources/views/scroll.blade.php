@extends('layouts.app')


@section('title','Find Local')


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

    body {
        background: #222225;
        color: white
    }

    .btn_review {
        background: #03a9f4;
        border: #03a9f4;
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
                            <span class="ng-binding">hjhj</span>
                        </p>

                        <p class="GuideProfile-location">
                           ghjghj
                        </p>
                    </div>

                    <div class="GuideProfile-priceWrapper ng-scope">
                        <span class="GuideProfile-price ng-binding">

                            Free
                        </span>

                    </div>

                    <div class="GuideMotto ReplyRate">
                        <div class="GuideMotto-content">
                            <span class="GuideMotto-quote GuideMotto-quote--left"><i class="fa fa-quote-left"></i></span>
                            <p class="ng-binding ng-isolate-scope">ghyh</p>
                            <span class="GuideMotto-quote GuideMotto-quote--right"><i class="fa fa-quote-right"></i></span>
                        </div>
                    </div>

                    <div class="GuideProfile-carousel">
                        {{--<img class="ng-scope ng-isolate-scope" src="{{ asset('/',$local->motto) }}" >--}}
                        <img class="ng-scope ng-isolate-scope" src="/img/profile1.jpg" >
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
                        <i class="fa fa-star ng-scope is-highlighted"></i>
                        <i class="fa fa-star ng-scope is-highlighted"></i>
                        <i class="fa fa-star ng-scope is-highlighted"></i>
                        <i class="fa fa-star ng-scope is-highlighted"></i>
                        <i class="fa fa-star ng-scope is-highlighted"></i>
                    </p>
                    <p class="ng-binding ng-scope">Reviews: <strong class="ng-binding">1</strong></p>

                </div>
                <div class="GuideProfile-actions-content">
                    <div>
                        <div class="GuideProfile-actions-buttons ng-scope ng-isolate-scope">
                                <div class="GuideProfile-actions-button GuideProfile-actions-button--wide GuideProfile-actions-button-double ng-scope">
                                    <div class="GuideProfile-actions-button-label">
                                        Create a trip with <strong class="ng-binding">45ytrtg</strong>
                                    </div>

                                    <a href="#" class="Button Button--blue Button--fullWidth Button--large-tablet">
                                        Create a Trip
                                    </a>
                                </div>
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
                <h1 class="ng-binding">Explore tyhty with tyhtyht</h1></div>
            <div class="GuideProfile-info-row  ng-scope">
                <div class="col-md-4-7">
                    <h2>I will show you</h2>
                </div>
                <div class="col-md-7-3">
                    <div>
                        <p class="Overflow-expandableText ng-binding">My city but you have to need enough time</p>
                    </div>

                </div>
            </div>
            <div class="GuideProfile-info-row ng-scope">
                <div class="col-md-4-7">
                    <h2>About me</h2>
                </div>
                <div class="col-md-7-3">
                    <div>
                        <p class="Overflow-expandableText ng-binding">tyhty</p>
                    </div>
                </div>
            </div>

            <div class="GuideProfile-info-row">
                <div class="col-md-4-7">
                    <h2>Languages</h2>
                </div>
                <div class="col-md-7-3">
                    <p>English</p>
                </div>
            </div>

            <div class="GuideProfile-info-row ng-scope">
                <div class="col-md-4-7">
                    <h2>Activities</h2>
                </div>
                <div class="col-md-7-3">
                    <div class="GuideActivities ng-isolate-scope">
                        <div class="GuideActivities-activity">
                            <span>Translation & Interpretation</span>
                        </div><!-- end ngRepeat: activity in ::ctrl.activities -->
                        <div class="GuideActivities-activity">
                            <span> Pick up & Driving Tours </span>
                        </div>
                        <div class="GuideActivities-activity">
                            <span>Shopping</span>
                        </div>
                        <div class="GuideActivities-activity">
                            <span> Food & Restaurants</span>
                        </div>
                        <div class="GuideActivities-activity">
                            <span> Food & Restaurants</span>
                        </div>
                        <div class="GuideActivities-activity">
                            <span> Food & Restaurants</span>
                        </div>
                        <div class="GuideActivities-activity">
                            <span> Food & Restaurants</span>
                        </div>
                        <div class="GuideActivities-activity">
                            <span> Food & Restaurants</span>
                        </div>
                    </div>
                </div>
            </div><!-- end ngIf: ctrl.showActivities() -->
        </div>
    </div>
</div>

<section class="GuideProfile-reviews">
    <div class="GuideProfile-container">

        <div class="review">
            {{--<h1>Star rating </h1>--}}
            <form method="post" action="">
                @csrf
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
                <textarea class="form-control" type="text" name="review" id="review" placeholder="Say Something About Ruhel"></textarea>

                <button class="btn btn-info btn_review" type="submit">Submit Review</button>
            </form>
        </div>

        <div class="Reviews-count">
            1 Review
        </div>

        <div class="ng-scope">
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
						          <a href="#"><strong class="ng-binding">Tuhin</strong></a>
						          <span class="Review-type ng-binding">as a traveller</span>
						        </span>
                                </p>
                                <p class="Review-date ng-binding">17 Oct 2020</p>
                            </div>
                        </div>

                        <div class="Review-content col-md-7-3">
                            <p class="Review-text ng-binding ng-scope">
                                He is a good guy really. Highly recommended</p>
                            <p class="Rating--small Rating">
                                <i class="fa fa-star ng-scope is-highlighted"></i>
                                <i class="fa fa-star ng-scope is-highlighted"></i>
                                <i class="fa fa-star ng-scope is-highlighted"></i>
                                <i class="fa fa-star ng-scope is-highlighted"></i>
                                <i class="fa fa-star ng-scope is-highlighted"></i>
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>



@endsection


@push('js')


@endpush