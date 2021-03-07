
@extends('admin.app')

@section('title','Admin dashboard')

@push('css')
<link rel="stylesheet" href="{{asset('admin/plugins')}}/datatables-bs4/css/dataTables.bootstrap4.css">
@endpush

@section('content')


    <div class="container">
        <div class="row mt-1">
            <div class="col-md-12">


                <div class="content-panel">
                    <div class="mt-3 mb-3">
                        {{--<a href="#" class="btn btn-md btn-primary"><i class="fa fa-plus"></i> <b> STUDENT</b></a>--}}

                    </div>
                    <table id="example1" class="table table-striped table-advance table-hover">

                        <h4><i class="fa fa-angle-right"></i> Bookings Table</h4>
                        <hr>

                        <thead>
                        <tr>
                            <th>S.I</th>
                            <th>Guide</th>
                            <th>Traveller</th>
                            <th>Number of visitors</th>
                            <th>Date</th>
                            <th>Location</th>
                            <th>Status</th>
                            <th>Action</th>
                        </tr>
                        </thead>
                        <tbody>

                        @foreach($bookings as $x)
                            <tr>
                                <td>{{ $loop->index+1 }}</td>
                                <td><a href="{{route('local',$x->local_id)}}" title="See guide details">{{ \App\User::find($x->local_id)->name }}</a></td>
                                <td><a href="{{route('local',$x->traveller_id)}}" title="See traveller details">{{ \App\User::find($x->traveller_id)->name }}</a></td>
                                {{--<td>{{ $x->email }}</td>--}}
                                <td>{{ $x->traveller_number }}</td>
                                <td>{{ $x->date }}</td>
                                <td>{{ str_limit($x->location,30) }}</td>
                                {{--<td><span>{{ $x->status }}</span></td>--}}
                                <td>
                                    @if($x->status=='Confirmed')
                                        <span class="MyTrip-deactivate btn btn-xs btn-success">{{ $x->status }}</span>
                                    @elseif($x->status=='Pending')
                                        <span class="MyTrip-deactivate btn btn-xs btn-warning">{{ $x->status }}</span>
                                    @else
                                        <span class="MyTrip-deactivate btn btn-xs btn-danger">{{ $x->status }}</span>
                                    @endif
                                </td>
                                <td>
                                    <a href="#" class="btn btn-success btn-xs ml-1" title="See details"><i class="fa fa-eye"></i></a>
                                </td>

                            </tr>
                        @endforeach
                        </tbody>
                    </table>

                </div>
                <!-- /content-panel -->
            </div>
            <!-- /col-md-12 -->
        </div>
    </div>

    @endsection

    @push('js')
            <!--Data Table js-->
    <script src="{{asset('admin/plugins')}}/datatables/jquery.dataTables.js"></script>
    <script src="{{asset('admin/plugins')}}/datatables-bs4/js/dataTables.bootstrap4.js"></script>
    <script>
        $(function () {
            $("#example1").DataTable();
            $('#example2').DataTable({
                "paging": true,
                "lengthChange": false,
                "searching": false,
                "ordering": true,
                "info": true,
                "autoWidth": false,
            });
        });
    </script>


    <!-- Script for Blocked/Unblock -->
    <script type="text/javascript">
        function blockUser(id) {
            swal({
                title: 'Are you sure?',
                //                text: "You won't be able to revert this!",
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
                document.getElementById('status-form-'+id).submit();
            } else if (
                    // Read more about handling dismissals
            result.dismiss === swal.DismissReason.cancel
            ) {
                swal(
                        'Cancelled',
                        'Your data is safe :)',
                        'error'
                )
            }
        })
        }
    </script>

    @endpush