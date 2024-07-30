@extends('admin.master')

@section('title', 'Profile')

@section('content')
    <div class="page-wrapper">
        <div class="content">
            <div class="page-header">
                <div class="page-title">
                    <h4>Profile</h4>
                </div>
            </div>

            <div class="card">
                <form action="{{ route('admin.update') }}" method="post" enctype="multipart/form-data">
                    @csrf
                    <div class="card-body">
                        <div class="profile-set">
                            <div class="profile-head">
                            </div>
                            <div class="profile-top">
                                <div class="profile-content">
                                    <div class="profile-contentimg">
                                        @if (Auth::user()->image == null)
                                            <img src="{{ asset('admin/img/default.png') }}" alt="img" id="blah">
                                        @else
                                            <img src="{{ asset('storage/users/' . Auth::user()->image) }}" alt="">
                                        @endif
                                        <div class="profileupload">
                                            <input type="file" name="image" id="imgInp">
                                            <a href="javascript:void(0);"><img src="{{ asset('admin/img/icons/edit-set.svg') }}"
                                                    alt="img"></a>
                                        </div>
                                    </div>
                                    <div class="profile-contentname">
                                        <h2>{{ Auth::user()->name }}</h2>
                                        <h4>Updates Your Photo and Personal
                                            Details.</h4>
                                    </div>
                                </div>
                                {{-- <div class="ms-auto">
                                    <a href="javascript:void(0);" class="btn btn-submit me-2">Save</a>
                                    <a href="javascript:void(0);"
                                    class="btn btn-cancel">Cancel</a>
                                </div> --}}
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-6 col-sm-12">
                                <div class="form-group">
                                    <label>Name</label>
                                    <input type="text" class="@error('name') is-invalid @enderror" name="name"
                                        value="{{ old('name', Auth::user()->name) }}">
                                    @error('name')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                    <input type="hidden" name="id" value="{{ Auth::user()->id }}">
                                </div>
                            </div>
                            <div class="col-lg-6 col-sm-12">
                                <div class="form-group">
                                    <label>Email</label>
                                    <input class="form-control text-muted @error('email') is-invalid @enderror"
                                        type="email" name="email" value="{{ old('email', Auth::user()->email) }}">
                                    @error('email')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-12">
                                <button type="submit" class="btn btn-submit me-2">Submit</button>
                                <a href="{{ route('dashboard') }}" class="btn btn-cancel">Cancel</a>
                            </div>
                        </div>
                        <form action="{{ route('admin.update') }}" method="POST">
                            @csrf

                        </form>
                    </div>
                </form>
            </div>

        </div>
    </div>
@endsection
