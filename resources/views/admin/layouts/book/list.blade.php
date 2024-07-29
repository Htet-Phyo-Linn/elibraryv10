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
                        src="{{ asset('admin/img/icons/plus.svg') }}" alt="img"
                        class="me-1">Add New Book</a>
            </div>
        </div>

        <div class="card">
            <div class="card-body">
                <div class="table-top">
                    <div class="search-set">
                        <div class="search-input">
                            <a class="btn btn-searchset"><img
                                    src="{{ asset('admin/img/icons/search-white.svg') }}"
                                    alt="img"></a>
                        </div>
                    </div>
                </div>

                <div class="table-responsive">
                    <table class="table  datanew">
                        <thead>
                            <tr>
                                <th>Product Name</th>
                                <th>SKU</th>
                                <th>Category </th>
                                <th>Brand</th>
                                <th>price</th>
                                <th>Unit</th>
                                <th>Qty</th>
                                <th>Created By</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td class="productimgname">
                                    <a href="javascript:void(0);"
                                        class="product-img">
                                        <img
                                            src="assets/img/product/product1.jpg"
                                            alt="product">
                                    </a>
                                    <a
                                        href="javascript:void(0);">Macbook
                                        pro</a>
                                </td>
                                <td>PT001</td>
                                <td>Computers</td>
                                <td>N/D</td>
                                <td>1500.00</td>
                                <td>pc</td>
                                <td>100.00</td>
                                <td>Admin</td>
                                <td>
                                    <a class="me-3"
                                        href="product-details.html">
                                        <img
                                            src="{{ asset('admin/img/icons/eye.svg') }}"
                                            alt="img">
                                    </a>
                                    <a class="me-3"
                                        href="editproduct.html">
                                        <img
                                            src="{{ asset('admin/img/icons/edit.svg') }}"
                                            alt="img">
                                    </a>
                                    <a class="confirm-text"
                                        href="javascript:void(0);">
                                        <img
                                            src="{{ asset('admin/img/icons/delete.svg') }}"
                                            alt="img">
                                    </a>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

    </div>
</div>
@endsection
