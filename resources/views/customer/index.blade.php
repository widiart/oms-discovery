@extends('layouts.admin')
@section('Title', 'Customers List')
@section('breadcrumbs')
    <li class="breadcrumb-item">
        <a href="{{ route('customer.index') }}">Customer</a>
    </li>
    <li class="breadcrumb-item active">
        <a href="#">Index</a>
    </li>
@endsection
@section('toolbar')
    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#customer-create">
        <i class="ti ti-plus"></i> Add New Customer
    </button>
@endsection
@section('content')
    <div class="card">
        <div class="card-body">
            <table id="customer-table" class="table">
                <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Name</th>
                        <th scope="col">Email</th>
                        <th scope="col">Phone</th>
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
    @include('customer.modal')
@endsection
@section('scripts')
    <script>
        var customerUrl = "{{ route('api.customer.data') }}";
        var customerCreateUrl = "{{ route('api.customer.create') }}";
        var customerReadUrl = "{{ route('api.customer.read', ':id') }}";
        var customerUpdateUrl = "{{ route('api.customer.update', ':id') }}";
        var customerDeleteUrl = "{{ route('api.customer.delete', ':id') }}";
    </script>
    <script src="{{ asset('assets/js/plugins/jquery.min.js') }}"></script>
    <script src="{{ asset('assets/js/plugins/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('assets/js/plugins/dataTables.bootstrap5.min.js') }}"></script>
    <script src="{{ asset('assets/js/plugins/autoNumeric.min.js') }}"></script>
    <script src="{{ asset('assets/js/plugins/sweetalert2.all.min.js') }}"></script>
    <script src="{{ asset('assets/js/pages/customer.js') }}"></script>
@endsection