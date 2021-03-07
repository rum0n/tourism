@extends('layouts.app')


@section('title','My Bookings')


@push('css')

@endpush

@section('banner')


@endsection


@section('content')

    <section class="Content ng-scope">
        <div class="MyTripsContainer">


            <h2 class="SavedTrip-header ng-scope">Current Bookings</h2>

            <div class="ng-scope">
                @forelse($my_bookings as $trip)
                    <div id="707105" class="MyTrip ng-scope">
                        <div class="MyTrip-header">
                            <img class="MyTrip-headerImage" src="{{asset('img/trip_header.jpg')}}">
                            <div class="MyTrip-headerImageOverlay"></div>
                            <h2 class="MyTrip-headerText">
                                <span class="ng-binding ng-scope">{{ str_limit($trip->location,70) }}</span>
                            </h2>
                        </div>
                        <div class="MyTrip-body">
                            <div class="MyTrip-details">
                                <div class="MyTrip-detailWrapper">
                                    <div class="MyTrip-detail">
                                        <span class="fa fa-calendar"></span>
                                  <span class="MyTrip-detailText">
                                    <span class="ng-binding ng-scope">{{ $trip->date }}</span>
                                  </span>
                                    </div>
                                </div>

                              <span class="MyTrip-actionButtons">

                                  @if($trip->status == 'Pending')
                                      <span class="MyTrip-deactivate btn">
                                          <button onclick="approveBooking({{ $trip->id }})" type="submit" class="btn btn-info btn-sm ml-3">Accept</button>
                                          <form id="approve-form-{{ $trip->id }}" action="{{ route('guide.approve',$trip->id) }}" method="get">
                                              @csrf
                                          </form>
                                      </span>

                                      <span class="MyTrip-delete">
                                          <button onclick="rejectBooking({{ $trip->id }})" type="submit" class="btn btn-warning btn-sm ml-3">Reject</button>
                                          <form id="reject-form-{{ $trip->id }}" action="{{ route('guide.reject',$trip->id) }}" method="get">
                                              @csrf
                                          </form>
                                      </span>
                                  @elseif($trip->status == 'Confirmed')
                                      <span class="MyTrip-deactivate btn btn-sm btn-success" title="You have accepted this">You accepted</span>
                                  @else
                                      <span class="MyTrip-deactivate btn btn-sm btn-danger" title="You have rejected this">Rejected</span>
                                  @endif

                              </span>
                            </div>
                            <div class=" MyTrip-details">
                                <div class="MyTrip-detail">
                                    <span class="MyTrip-detailText2">Number of people :</span>
                                <span class="MyTrip-detailText2Value ng-binding">
                                    @if($trip->traveller_number == 1)
                                        Just Me
                                    @elseif($trip->traveller_number == 2)
                                        Two People
                                    @elseif($trip->traveller_number == 3)
                                        Three People
                                    @else
                                        More than three
                                    @endif
                                </span>
                                </div>
                                <br>
                                <div class="MyTrip-detail">
                                    <span class="MyTrip-detailText2">Local Guide : </span>
                                    <a href="{{ route('local',$trip->traveller_id) }}" class="MyTrip-detailText2Value ng-binding">
                                        {{\App\User::find($trip->traveller_id)->name}}
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                @empty
                    <h3 class="SavedTrip-header ng-scope text-warning">Currently you don't have any trips !! Create one</h3>
                @endforelse
            </div>

        </div>
    </section>



    @endsection


    @push('js')

    <!--Onclick approve js-->
    <script type="text/javascript">
        function approveBooking(id) {
            swal({
                title: 'Are you sure?',
                text: "You won't be able to revert this!",
                type: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, do it!',
                cancelButtonText: 'No, cancel!',
                confirmButtonClass: 'btn btn-success',
                cancelButtonClass: 'btn btn-danger mr-2',
                buttonsStyling: true,
                reverseButtons: true
            }).then((result) => {
                if (result.value) {
                event.preventDefault();
                document.getElementById('approve-form-'+id).submit();
            } else if (
                    // Read more about handling dismissals
            result.dismiss === swal.DismissReason.cancel
            ) {
                swal(
                        'Cancelled',
                        'Your data is unchanged :)',
                        'error'
                )
            }
        })
        }
    </script>


    <!--Onclick Reject js-->
    <script type="text/javascript">
        function rejectBooking(id) {
            swal({
                title: 'Are you sure?',
                text: "You won't be able to revert this!",
                type: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, do it!',
                cancelButtonText: 'No, cancel!',
                confirmButtonClass: 'btn btn-success',
                cancelButtonClass: 'btn btn-danger mr-2',
                buttonsStyling: true,
                reverseButtons: true
            }).then((result) => {
                if (result.value) {
                event.preventDefault();
                document.getElementById('reject-form-'+id).submit();
            } else if (
                    // Read more about handling dismissals
            result.dismiss === swal.DismissReason.cancel
            ) {
                swal(
                        'Cancelled',
                        'Your data is unchanged :)',
                        'error'
                )
            }
        })
        }
    </script>


    @endpush