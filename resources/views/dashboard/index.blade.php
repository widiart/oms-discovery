@extends('layouts.admin')
@section('content')
    <!-- [ sample-page ] start -->
    <div class="col-md-6 col-xl-3">
        <x-simple-card title="Total Customer" id="total-users" />
    </div>
    <div class="col-md-6 col-xl-3">
        <x-simple-card title="Active Customer" id="active-users" />
    </div>
    <div class="col-md-6 col-xl-3">
        <x-simple-card title="Total Order" id="total-order" />
    </div>
    <div class="col-md-6 col-xl-3">
        <x-simple-card title="Total Sales" id="total-sales" />
    </div>

    <div class="col-md-12">
        <h5 class="mb-3">Sales Overview</h5>
        <div class="card">
            <div class="card-body">
                <div id="sales-overview"></div>
            </div>
        </div>
    </div>

@endsection
@section('scripts')
    <script>
        var summaryUrl = "{{ route('api.dashboard.summary') }}";
        var salesOverviewUrl = "{{ route('api.dashboard.sales-overview') }}";
    </script>
    <script src="{{ asset('assets/js/plugins/jquery.min.js') }}"></script>
	<script src="{{ asset('assets/js/pages/dashboard-default.js') }}"></script>
	<script src="{{ asset('assets/js/pages/dashboard.js') }}"></script>
@endsection