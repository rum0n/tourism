@extends('admin.app')


@section('title','User')


@push('css')

@endpush


@section('content')
    <section id="main-content">
        <section class="wrapper">
            <!-- row -->
            <div class="row mt">
                <div class="col-md-10 offset-md-1">
                    <div class="content-panel">
                        <div class="col-md-4 offset-md-4 mb-5 mt-5">
                            <img src="{{ asset('profile/picture/'.$user->pro_pic) }}" alt="" class="img img-responsive img-thumbnail" width="300">
                        </div>
                        <table class="table table-striped table-advance table-hover">
                            <tr>
                                <th>Name</th><td>{{ $user->name }}</td>
                            </tr>

                            <tr>
                                <th>Email</th><td>{{ $user->email }}</td>
                            </tr>

                            <tr>
                                <th>Phone</th><td>{{ $user->phone }}</td>
                            </tr>
                            <tr>
                                <th>Address</th><td>{{ $user->location }}</td>
                            </tr>
                            <tr>
                                <th>Fee $(per hour)</th><td>{{ $user->price }}</td>
                            </tr>
                            <tr>
                                <th>Motto</th><td>{{ $user->motto }}</td>
                            </tr>

                            <tr>
                                <th>About</th><td>{{ $user->about }}</td>
                            </tr>
                            <tr>
                                <th>Status</th><td>{{ ($user->is_approved==1)?'Active':'Blocked' }}</td>
                            </tr>

                        </table>

                            {{--<button onclick="deleteUser({{ $user->id }})" type="submit" class="btn btn-danger btn-lg ml-1" >Delete</button>--}}
                            {{--<form id="delete-form-{{ $user->id }}" action="{{ route('admin.users.destroy',$user->id) }}" method="POST">--}}
                                {{--@csrf--}}
                                {{--@method('DELETE')--}}
                            {{--</form>--}}

                    </div>
                    <!-- /content-panel -->
                </div>
            </div>
        </section>
    </section>
@endsection


@push('js')
    <!-- Script for Delete -->
    <script type="text/javascript">
        function deleteUser(id) {
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
                document.getElementById('approve-form-'+id).submit();
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