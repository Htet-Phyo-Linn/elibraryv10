@extends('admin.master')

@section('title', 'Edit Category')

@section('content')
    <div class="page-wrapper">
        <div class="content">
            <div class="page-header">
                <div class="page-title">
                    <h4>Edit Category</h4>
                    {{-- <h6>Edit a product Category</h6> --}}
                </div>
            </div>

            <div class="card">
                <div class="card-body">
                    <div class="row">
                        <form action="{{ route('category.edit') }}" method="POST">
                            @csrf
                            <div class="col-lg-6 col-sm-6 col-12">
                                <div class="form-group">
                                    <label>Category Name</label>
                                    <input type="text" name="name" value="{{ old('name', $data->name) }}">
                                    <input type="hidden" name="id" value="{{ $data->id }}">
                                </div>
                            </div>
                            <div class="col-lg-12">
                                <button href="submit" class="btn btn-submit me-2">Submit</button>
                                <a href="{{ route('category.list') }}" class="btn btn-cancel">Cancel</a>
                            </div>
                        </form>
                    </div>
                </div>
            </div>

        </div>
    </div>
@endsection
