@extends('layouts.app')


@section('title','Find Local')


@push('css')
<style>
    .Wrapper {
        padding-bottom: 200px;
    }
</style>

@endpush

@section('banner')


@endsection


@section('content')

    <section class="Content ng-scope" style="margin-top: -28px">
        <div class="MyTripsContainer">
            <div class="CreateTrip-container">
                <div class="CreateTrip-overlay"></div>
                <div class="CreateTrip-wrapper">
                    <div class="CreateTrip-header">
                        My Trips
                    </div>

                    <div class="CreateTrip-tagline"></div>

                    <form action="{{ route('user.createtrip',$local->id) }}" method="post" class="CreateTrip-form Form ng-dirty" name="tripForm">
                        @csrf
                        <h2 class="CreateTrip-form-header">Create a trip</h2>

                        <div class="CreateTrip-form-field-wrapper row">
                            <!-- LOCATION -->
                            <div class="CreateTrip-searchfield col-xs-12">
                                <label class="BookingForm-label BookingForm-label--inline" for="location">Where are you going?</label>
                                <div class="CreateTrip-searchfield-wrapper">
                                    <button class="ClearButton" type="button" style="display: none;"></button>
                                    <div class="CreateTrip-searchfield-icon">
                                        <i class="fa fa-search"></i>
                                    </div>
                                    <input class="CreateTrip-searchfield-input" placeholder="Where next?" name="location" value="{{$local->location}}">
                                </div>

                            </div>

                            <!-- CALENDAR DATES -->
                            <div class="CreateTrip-dates">
                                <div class="row">

                                    <div class="col-xs-12">
                                        <span class="BookingForm-label BookingForm-label--inline">Tour Date</span>
                                        <div class="CreateTrip-calendarInputWrapper">
                                            <i class="fa fa-calendar CreateTrip-calendarIcon"></i>
                                            <input class="CreateTrip-calendarInput" id="pickdate" name="date"  value="">
                                            <input type="hidden" id="booked_dates" value="{{$booked}}">
                                        </div>
                                    </div>

                                </div>
                            </div>

                        </div>

                        <!-- NUMBER OF PEOPLE -->
                        <div class="row">
                            <div class="col-xs-12 traveller">
                                <span class="CreateTrip-label col-xs-5">Number of people</span>
                                <div class="CreateTrip-FormSelect Form-select col-xs-6">
                                    <select name="numberOfPeople">
                                        <option label="Just me" value="1" selected="selected">Just me</option>
                                        <option label="Two people" value="2">Two people</option>
                                        <option label="Three people" value="3">Three people</option>
                                        <option label="More than three" value="4">More than three</option>
                                    </select>
                                </div>
                            </div>
                        </div>

                        <div class="CreateTrip-interested row">
                            <div class="col-md-5">
                                <span class="CreateTrip-label BookingForm-label--inline">Local Guide Name</span>
                            </div>
                            <div class="col-md-5">
                                <div class="row">
                                    <div class="col-xs-6">
                                        {{--<input name="local" type="hidden">--}}
                                        <span style="padding-top: 5px">{{$local->name}}</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- SUBMIT -->
                        <div class="CreateTrip-button-wrapper">
                            <button class="Button ng-isolate-scope" type="submit">Create new trip</button>
                            <!-- ERRORS -->
                            <!-- ngIf: $ctrl.error -->
                        </div>

                    </form>
                </div>
            </div>


        </div>
    </section>



    @endsection


    @push('js')

    <!-- =====================For date Picker======================== -->

    <script>
        $(function() {
            $( "#pickdate" ).datepicker({
                dateFormat: 'dd MM yy',
                minDate: 0,
                beforeShowDay: checkBadDates
            });

        });


        var $booked = $('#booked_dates').val();

        var $myBadDates = $booked.split('|');


        function checkBadDates(mydate){

            var $return=true;
            var $returnclass ="available";
            $checkdate = $.datepicker.formatDate('dd MM yy', mydate);
            for(var i = 0; i < $myBadDates.length; i++)
            {
                if($myBadDates[i] == $checkdate)
                {
                    $return = false;
                    $returnclass= "unavailable";
                }
            }
            return [$return,$returnclass];
        }
    </script>

    @endpush