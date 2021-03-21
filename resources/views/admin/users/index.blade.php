<x-admin-master>

    @section('content')

        <h1>All Users</h1>

        @if(session('deleted-user'))
            <div class="alert alert-danger">{{ session('deleted-user') }}</div>
        @endif

    <!-- DataTales Example -->
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">DataTables Example</h6>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                        <thead>
                        <tr>
                            <th>ID</th>
                            <th>Username</th>
                            <th>Name</th>
                            <th>E-mail</th>
                            <th>Image</th>
                            <th>Created Date</th>
                            <th>Updated Date</th>
                            <th>DELETE</th>
                            <th>EDIT</th>
                        </tr>
                        </thead>
                        <tfoot>
                        <tr>
                            <th>ID</th>
                            <th>Username</th>
                            <th>Name</th>
                            <th>E-mail</th>
                            <th>Image</th>
                            <th>Created Date</th>
                            <th>Updated Date</th>
                            <th>DELETE</th>
                            <th>EDIT</th>
                        </tr>
                        </tfoot>
                        <tbody>
                        @foreach( $users as $user )
                            <tr>
                                <td>{{ $user->id }}</td>
                                <td>{{ $user->name }}</td>
                                <td>{{ $user->username }}</td>
                                <td>{{ $user->email }}</td>
                                <td><img src="{{ asset( $user->avatar) }}" height="40"/></td>
                                <td>{{ $user->created_at }}</td>
                                <td>{{ $user->updated_at }}</td>
                                <td>
{{--                                @can('view', $post)--}}
                                    <form method="POST" action="{{ route('admin.users.destroy', $user->id) }}">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger">Delete</button>
                                    </form>
{{--                                @endcan--}}
                                </td>
                                <td>
                                    <a href="{{ route('users.profile.show', $user->id) }}">
                                        <button class="btn btn-primary">Edit</button>
                                    </a>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

    @endsection

    @section('scripts')
    <!-- Page level plugins -->
        <script type="text/javascript" src="{{ asset('vendor/datatables/jquery.dataTables.min.js') }}"></script>
        <script type="text/javascript" src="{{ asset('vendor/datatables/dataTables.bootstrap4.min.js') }}"></script>

        <!-- Page level custom scripts -->
        <script  type="text/javascript" src="{{ asset('js/demo/datatables-demo.js') }}"></script>
    @endsection
</x-admin-master>
