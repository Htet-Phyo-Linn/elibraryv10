@extends('admin.master')

@section('title', 'Category List')

@section('content')
    <div class="page-wrapper">
        <div class="content">
            <div class="page-header">
                <div class="page-title">
                    <h4>Author List</h4>
                </div>
                <div class="page-btn">
                    <a class="btn btn-added" data-bs-toggle="modal" data-bs-target="#addpayment"><img
                            src="{{ asset('admin/img/icons/plus.svg') }}" alt="img" class="me-1">Add New Author</a>
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
                                    <th>No.</th>
                                    <th>Author name</th>
                                    <th class="text-end">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($items as $item)
                                    <tr>
                                        <td>{{ $count }}</td>
                                        <td>{{ $item->name }}</td>
                                        <td class="text-end">
                                            <a class="me-3" href="{{ route('author.editPage', $item->id) }}">
                                                <img src="{{ asset('admin/img/icons/edit.svg') }}" alt="img">
                                            </a>
                                            <a class="me-3 confirm-text" href="{{ route('author.delete', $item->id) }}">
                                                <img src="{{ asset('admin/img/icons/delete.svg') }}" alt="img">
                                            </a>
                                        </td>
                                    </tr>
                                    <?php
                                    $count = $count + 1;
                                    ?>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

        </div>

    </div>


@endsection

@section('modal')
    <div class="modal fade" id="addpayment" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Add Author </h5>
                    <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="{{ route('author.create') }}" method="POST">
                    @csrf
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-12">
                                <div class="form-group">
                                    <label>Author Name<span class="manitory">*</span></label>
                                    <input type="text" name="name">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-submit">Confirm</button>
                        <button type="button" class="btn btn-cancel" data-bs-dismiss="modal">Cancel</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    {{-- <div class="modal fade" id="editpayment" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Edit Tax</h5>
                    <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-12">
                            <div class="form-group">
                                <label>Tax Name<span class="manitory">*</span></label>
                                <input type="text" value="SGST 4.5%	">
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="form-group">
                                <label>Tax Rate(%)<span class="manitory">*</span></label>
                                <input type="text" value="4.50">
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="form-group mb-0">
                                <label>Status</label>
                                <select class="select">
                                    <option> Active</option>
                                    <option> InActive</option>
                                </select>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-submit">Update</button>
                    <button type="button" class="btn btn-cancel" data-bs-dismiss="modal">Cancel</button>
                </div>
            </div>
        </div>
    </div> --}}
@endsection
