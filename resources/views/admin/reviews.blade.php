
@extends('admin.app')

@section('title','Review & Ratings')

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

                        <h4><i class="fa fa-angle-right"></i> Reviews</h4>
                        <hr>

                        <thead>
                        <tr>
                            <th>S.I</th>
                            <th>Reviewed by</th>
                            <th>To Guide</th>
                            <th>Rating</th>
                            <th>Comment</th>
                            {{--<th>Reviewed date</th>--}}
                            <th>Action</th>
                        </tr>
                        </thead>
                        <tbody>

                        @foreach($reviews as $x)
                            <tr>
                                <td>{{ $loop->index+1 }}</td>
                                <td><a href="{{route('local',$x->user_id)}}" title="See traveller details">{{ \App\User::find($x->user_id)->name }}</a></td>
                                <td><a href="{{route('local',$x->profile_id)}}" title="See guide details">{{ \App\User::find($x->profile_id)->name }}</a></td>
                                <td>{{ $x->rating }}</td>
                                <td>{{ $x->review }}</td>
                                {{--<td>{{ $x->created_at }}</td>--}}
                                <td>

                                    <button onclick="deleteReview({{ $x->id }})" type="submit" class="btn btn-danger btn-sm ml-3">Delete</button>
                                    <form id="delete-review-{{ $x->id }}" action="{{ route('admin.delete.review',$x->id) }}" method="post">
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
        function deleteReview(id) {
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
                document.getElementById('delete-review-'+id).submit();
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