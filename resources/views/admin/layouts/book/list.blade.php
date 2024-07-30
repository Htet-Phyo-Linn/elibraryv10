@extends('admin.master')

@section('title', 'Book List')

@section('content')
    <div class="page-wrapper">
        <div class="content">
            <div class="page-header">
                <div class="page-title">
                    <h4>Book List</h4>
                </div>
                <div class="page-btn">
                    <a href="{{ route('book.addPage') }}" class="btn btn-added"><img
                            src="{{ asset('admin/img/icons/plus.svg') }}" alt="img" class="me-1">Add New Book</a>
                </div>
            </div>

            @if (session('createSuccess'))
                <div class="row">
                    <div class="alert alert-success alert-dismissible" role="alert">
                        <strong><i class="fa-solid fa-circle-check me-2"></i>{{ session('createSuccess') }}</strong>
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                </div>
            @endif

            @if (session('updateSuccess'))
                <div class="row">
                    <div class="alert alert-success alert-dismissible" role="alert">
                        <strong><i class="fa-solid fa-circle-check me-2"></i>{{ session('updateSuccess') }}</strong>
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                </div>
            @endif

            @if (session('deleteSuccess'))
                <div class="row">
                    <div class="alert alert-danger alert-dismissible" role="alert">
                        <strong><i class="fa-solid fa-circle-check me-2"></i>{{ session('deleteSuccess') }}</strong>
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                </div>
            @endif

            <div class="card">
                <div class="card-body">
                    <div class="table-top">
                        <div class="search-set">
                            <div class="search-input">
                                <a class="btn btn-searchset"><img src="{{ asset('admin/img/icons/search-white.svg') }}"
                                        alt="img"></a>
                            </div>
                        </div>
                    </div>

                    <div class="table-responsive">
                        <table class="table  datanew">
                            <thead>
                                <tr>
                                    <th>Title</th>
                                    <th>Category </th>
                                    <th>Author</th>
                                    <th>Released Year</th>
                                    <th>Description</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($books as $book)
                                    <tr>
                                        <td class="productimgname">
                                            <a href="javascript:void(0);" class="product-img">
                                                <img src="{{ asset('storage/books/' . $book->image) }}" alt="book">
                                            </a>
                                            <a href="javascript:void(0);">{{ $book->title }}</a>
                                        </td>
                                        <td>{{ $book->category_name }}</td>
                                        <td>{{ $book->author_name }}</td>
                                        <td>{{ $book->production_year }}</td>
                                        <td>{{ $book->description }}</td>
                                        <td>
                                            <a class="me-3" href="product-details.html">
                                                <img src="{{ asset('admin/img/icons/eye.svg') }}" alt="img">
                                            </a>
                                            <a class="me-3" href="editproduct.html">
                                                <img src="{{ asset('admin/img/icons/edit.svg') }}" alt="img">
                                            </a>
                                            <a class="confirm-text" href="{{ route('book.delete', $book->id) }}">
                                                <img src="{{ asset('admin/img/icons/delete.svg') }}" alt="img">
                                            </a>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

        </div>
    </div>
@endsection
