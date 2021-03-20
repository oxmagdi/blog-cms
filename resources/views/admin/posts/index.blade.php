<x-admin-master>

    @section('content')

        <h1>All Posts</h1>

        @if(session('message'))
            <div class="alert alert-danger">{{ session('message') }}</div>
        @elseif(session('created-post-message'))
            <div class="alert alert-success">{{ session('created-post-message') }}</div>
        @elseif(session('updated-post-message'))
            <div class="alert alert-success">{{ session('updated-post-message') }}</div>
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
                            <th>Owner</th>
                            <th>Title</th>
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
                            <th>Owner</th>
                            <th>Title</th>
                            <th>Image</th>
                            <th>Created Date</th>
                            <th>Updated Date</th>
                            <th>DELETE</th>
                            <th>EDIT</th>
                        </tr>
                        </tfoot>
                        <tbody>
                            @foreach($posts as $post)
                                <tr>
                                    <td>{{ $post->id }}</td>
                                    <td>{{ $post->user->name }}</td>
                                    <td>{{ $post->title }}</td>
                                    <td><img src="{{ asset($post->post_image) }}" height="40"/></td>
                                    <td>{{ $post->created_at }}</td>
                                    <td>{{ $post->updated_at }}</td>
                                    <td>
                                        @can('view', $post)
                                        <form method="POST" action="{{ route('posts.destroy', $post->id) }}">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger">Delete</button>
                                        </form>
                                        @endcan
                                    </td>
                                    <td><a href="{{ route('posts.edit', $post->id) }}"><button class="btn btn-primary">Edit</button></a></td>
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
