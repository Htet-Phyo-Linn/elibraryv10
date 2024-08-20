@extends('user.master') @section('title', 'profile')

@section('content')
    <div class="container-fluid fruite py-5">
        <div class="container py-5">
            <div class="tab-class text-center">
                <div class="row g-4">
                    <div class="col-lg-4 text-start">
                        <h2>Profile</h2>
                    </div>
                </div>
                {{-- <div class="tab-content">
                <div id="tab-1" class="tab-pane fade show p-0 active">
                    <h1>hello</h1>
                </div>
            </div> --}}

                <form action="{{ route('user.update') }}" method="POST">
                    @csrf
                    <div class="row text-start mt-3">
                        <div class="col-lg-6">
                            <label for="name">Your name</label>
                            <input type="text" name="name" class="form-control"
                                value="{{ old('name', Auth::user()->name) }}">
                        </div>
                        <div class="col-lg-6">
                            <label for="name">Your email</label>
                            <input type="email" name="email" class="form-control"
                                value="{{ old('email', Auth::user()->email) }}">
                        </div>
                        <div class="col-md-3 mt-3">
                            <button class="btn btn-success">Update</button>
                        </div>
                    </div>
                </form>
                @if(session('changeSuccess'))
                <div class="alert alert-success alert-dismissible fade show mt-3" role="alert">
                    <strong>Success!</strong>
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                  </div>
                @endif
                <div class="row g-4 mt-2">
                    <div class="col-lg-4 text-start">
                        <h2>Change Password</h2>
                    </div>
                </div>
                <form action="{{ route('user.changePassword') }}" method="POST">
                    @csrf
                    <div class="row text-start mt-3">
                        <div class="col-lg-7">
                            <label for="name">Current Password</label>
                            <input type="password" name="password"
                                class="form-control @error('password') is-invalid @enderror @if (session('notMatch')) is-invalid @endif">
                            @if (session('notMatch'))
                                <div class="invalid-feedback">
                                    {{ session('notMatch') }}hi
                                </div>
                            @else
                                @error('password')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            @endif

                        </div>
                        <div class="col-lg-7">
                            <label for="name">New Password</label>
                            <input type="password" name="newPassword"
                                class="form-control @error('newPassword') is-invalid @enderror">
                            @error('newPassword')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror

                        </div>
                        <div class="col-lg-7">
                            <label for="name">Confirm New Password</label>
                            <input type="password" name="confirmPassword"
                                class="form-control @error('newPassword') is-invalid @enderror">
                            @error('confirmPassword')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>

                    </div>
                    <div class="col-md-3 text-start mt-3">
                        <button class="btn btn-success">Update</button>
                    </div>
                </form>
                <form action="{{ route('logout') }}" method="POST">
                    @csrf
                    <div class="col-md-3 text-start mt-5">
                        <button class="btn btn-danger">Logout</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
