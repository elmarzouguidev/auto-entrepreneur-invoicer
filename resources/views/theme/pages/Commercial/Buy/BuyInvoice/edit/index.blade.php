@extends('theme.layouts.app')

@section('content')
    <div class="container-fluid">

        @include('theme.pages.Commercial.Buy.BuyInvoice.__title')

        @include('theme.pages.Commercial.Buy.BuyInvoice.edit.__form')

    </div>
@endsection

@section('css')
    <link href="{{ asset('assets/libs/bootstrap-datepicker/css/bootstrap-datepicker.min.css') }}" rel="stylesheet"
        type="text/css">
@endsection

@push('scripts')
    <script src="{{ asset('assets/libs/bootstrap-datepicker/js/bootstrap-datepicker.min.js') }}"></script>
@endpush
