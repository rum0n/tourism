
@extends('admin.app')

@section('title','All user')

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

                        <h4><i class="fa fa-angle-right"></i> User Table</h4>
                        <hr>

                        <thead>
                        <tr>
                            <th>S.I</th>
                            <th> Name</th>
                            <th>Email</th>
                            <th>Picture</th>
                            <th>User Type</th>
                            <th>Status</th>
                            <th>Action</th>
                        </tr>
                        </thead>
                        <tbody>

                            @foreach($users as $x)
                                <tr>
                                    <td>{{ $loop->index+1 }}</td>
                                    <td>{{ $x->name }}</td>
                                    <td>{{ $x->email }}</td>
                                    <td>
                                        <img src="{{ asset('profile/picture/'.$x->pro_pic) }}" class="img-responsive img-thumbnail" width="100">
                                    </td>

                                    <td>
                                        <button class="btn btn-{{($x->role_id==2)?'primary':'info'}} btn-sm">{{ ($x->role_id==3)?'Traveller':'Local' }}</button>

                                    </td>
                                    <td>
                                        <button onclick="blockUser({{ $x->id }})" class="btn btn-{{($x->is_approved==1)?'success':'danger'}} btn-sm">{{ ($x->is_approved==1)?'Block':'Unblock' }}</button>
                                        <form id="status-form-{{ $x->id }}" class="form-horizontal" action="{{ route('admin.user_status',$x->id)  }}" method="get">
                                            @csrf
                                        </form>
                                        {{--<a  href="{{ route('admin.user_status',$x->id)  }}"  class="btn btn-{{($x->is_approved==1)?'success':'danger'}} btn-sm" >{{ ($x->is_approved==1)?'Block':'Unblock' }}</a>--}}
                                    </td>


                                    <td>
                                        <a href="{{ route('admin.users.show',$x->id) }}" class="btn btn-success btn-xs ml-1" title="See Students details"><i class="fa fa-eye"></i></a>
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