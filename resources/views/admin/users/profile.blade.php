<x-admin-master>
    @section('content')
        <h1>User Profile {{ $user->username }}</h1>

        <div class="rwo">
            @if(session('profile-update'))
                <div class="alert alert-danger">{{ session('profile-update') }}</div>
            @endif
            <div class="col-sm-6">
                <form method="post" action="{{ route('users.profile.update', $user) }}" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')

                    <div class="mb-4">
                        <img class="img-profile rounded-circle" src="{{ asset($user->avatar) }}" width="48" height="48">
                    </div>

                    <div class="form-group">
                        <label for="user_image">User Image</label>
                        <input type="file"
                               name="avatar" id="avatar"
                               class="form-control @error('avatar') is-invalid @enderror">

                        @error('avatar')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="username">Username</label>
                        <input type="text"
                               name="username" id="username"
                               class="form-control @error('username') is-invalid @enderror"
                               value="{{ $user->username }}">

                        @error('username')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror

                    </div>

                    <div class="form-group">
                        <label for="name">Name</label>
                        <input type="text"
                               name="name" id="name"
                               class="form-control @error('name') is-invalid @enderror"
                               value="{{ $user->name }}">

                        @error('name')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror

                    </div>

                    <div class="form-group">
                        <label for="email">E-mail</label>
                        <input type="email"
                               name="email" id="email"
                               class="form-control @error('email') is-invalid @enderror"
                               value="{{ $user->email }}">

                        @error('email')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror

                    </div>
                    <div class="form-group">
                        <label for="password">Password</label>
                        <input type="password"
                               name="password" id="password"
                               class="form-control">

                    </div>
                    <div class="form-group">
                        <label for="password_confirmation">Confirm Password</label>
                        <input type="password"
                               name="password_confirmation" id="password_confirmation"
                               class="form-control">
                    </div>

                    <button type="submit" class="btn btn-primary">Submit</button>
                </form>
            </div>
        </div>
    @endsection
</x-admin-master>
