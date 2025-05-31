@extends('layouts.admin')
@section('Title', 'Orders List')
@section('breadcrumbs')
    <li class="breadcrumb-item">
        <a href="{{ route('order.index') }}">Order</a>
    </li>
    <li class="breadcrumb-item active">
        <a href="#">Index</a>
    </li>
@endsection
@section('toolbar')
    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#order-create">
        <i class="ti ti-plus"></i> Add New Order
    </button>
@endsection
@section('content')
    <div class="card">
        <div class="card-body">
            <table id="order-table" class="table">
                <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Order Number</th>
                        <th scope="col">Customer Name</th>
                        <th scope="col">Product Name</th>
                        <th scope="col">Quantity</th>
                        <th scope="col">Total Price</th>
                        <th scope="col">Order Date</th>
                        <th scope="col">Action</th>
                    </tr>
                </thead>
                <tbody>
                    <tr id="loading-row">
                        <td colspan="8" class="text-center">
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
    @include('order.modal')
@endsection
@section('scripts')
    <script>
        var orderUrl = "{{ route('api.order.data') }}";
        var orderCreateUrl = "{{ route('api.order.create') }}";
        var orderCompleteUrl = "{{ route('api.order.complete', ':id') }}";
        var orderCancelUrl = "{{ route('api.order.cancel', ':id') }}";
        var productUrl = "{{ route('api.product.data-all') }}";
        var customerUrl = "{{ route('api.customer.data-all') }}";
    </script>
    <script src="{{ asset('assets/js/plugins/jquery.min.js') }}"></script>
    <script src="{{ asset('assets/js/plugins/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('assets/js/plugins/dataTables.bootstrap5.min.js') }}"></script>
    <script src="{{ asset('assets/js/plugins/autoNumeric.min.js') }}"></script>
    <script src="{{ asset('assets/js/plugins/sweetalert2.all.min.js') }}"></script>
    <script src="{{ asset('assets/js/pages/order.js') }}"></script>
@endsection