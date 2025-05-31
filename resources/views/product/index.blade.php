@extends('layouts.admin')
@section('Title', 'Products List')
@section('breadcrumbs')
    <li class="breadcrumb-item">
        <a href="{{ route('product.index') }}">Product</a>
    </li>
    <li class="breadcrumb-item active">
        <a href="#">Index</a>
    </li>
@endsection
@section('toolbar')
    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#product-create">
        <i class="ti ti-plus"></i> Add New Product
    </button>
@endsection
@section('content')
    <div class="card">
        <div class="card-body">
            <table id="product-table" class="table">
                <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Name</th>
                        <th scope="col">Price</th>
                        <th scope="col">Stock</th>
                        <th scope="col">Status</th>
                        <th scope="col">Action</th>
                    </tr>
                </thead>
                <tbody>
                    <tr id="loading-row">
                        <td colspan="6" class="text-center">
                            <div class="spinner-border text-primary" role="status">
                                <span class="visually-hidden">Loading...</span>
                            </div>
                            <div>
                                Loading ...
                            </div>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
    @include('product.modal')
@endsection
@section('scripts')
    <script>
        var productUrl = "{{ route('api.product.data') }}";
        var productCreateUrl = "{{ route('api.product.create') }}";
        var productReadUrl = "{{ route('api.product.read', ':id') }}";
        var productUpdateUrl = "{{ route('api.product.update', ':id') }}";
        var productDeleteUrl = "{{ route('api.product.delete', ':id') }}";
    </script>
    <script src="{{ asset('assets/js/plugins/jquery.min.js') }}"></script>
    <script src="{{ asset('assets/js/plugins/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('assets/js/plugins/dataTables.bootstrap5.min.js') }}"></script>
    <script src="{{ asset('assets/js/plugins/autoNumeric.min.js') }}"></script>
    <script src="{{ asset('assets/js/plugins/sweetalert2.all.min.js') }}"></script>
    <script src="{{ asset('assets/js/pages/product.js') }}"></script>
@endsection