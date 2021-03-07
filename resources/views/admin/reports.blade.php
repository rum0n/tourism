
@extends('admin.app')

@section('title','Reports or Complain about local Guide')

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

                        <h4><i class="fa fa-angle-right"></i> Reports</h4>
                        <hr>

                        <thead>
                        <tr>
                            <th>S.I</th>
                            <th>Reported by</th>
                            <th>Reported to</th>
                            <th>Complain</th>
                            <th>Action</th>
                        </tr>
                        </thead>
                        <tbody>

                        @foreach($reports as $x)
                            <tr>
                                <td>{{ $loop->index+1 }}</td>
                                <td><a href="{{route('local',$x->reporter_id)}}" title="See traveller details">{{ \App\User::find($x->reporter_id)->name }}</a></td>
                                <td><a href="{{route('local',$x->profile_id)}}" title="See guide details">{{ \App\User::find($x->profile_id)->name }}</a></td>
                                <td>{{ $x->report }}</td>
                                <td>
                                    <button onclick="deleteReport({{ $x->id }})" type="submit" class="btn btn-danger btn-sm ml-3">Delete</button>
                                    <form id="delete-report-{{ $x->id }}" action="{{ route('admin.delete.report',$x->id) }}" method="post">
                                        @csrf
                                    </form>
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

    <!--script for this pages-->
    <script type="text/javascript">
        function deleteReport(id) {
            swal({
                title: 'Are you sure?',
                text: "You won't be able to revert this!",
                type: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, delete it!',
                cancelButtonText: 'No, cancel!',
                confirmButtonClass: 'btn btn-success',
                cancelButtonClass: 'btn btn-danger mr-2',
                buttonsStyling: true,
                reverseButtons: true
            }).then((result) => {
                if (result.value) {
                event.preventDefault();
                document.getElementById('delete-report-'+id).submit();
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