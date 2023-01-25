@extends('theme.layouts.app')

@section('content')

    <div class="container-fluid">

        @include('theme.pages.Commercial.Buy.BuyInvoice.__title')

        @include('theme.pages.Commercial.Buy.BuyInvoice.create.__form')

    </div>

@endsection

@section('css')

    <link href="{{ asset('assets/libs/select2/css/select2.min.css') }}" rel="stylesheet" type="text/css"/>
    <link href="{{ asset('assets/libs/bootstrap-datepicker/css/bootstrap-datepicker.min.css') }}" rel="stylesheet"
          type="text/css">

@endsection

@once

@push('scripts')

    <script src="{{ asset('assets/libs/jquery.repeater/jquery.repeater.min.js') }}"></script>
    <script src="{{ asset('assets/libs/select2/js/select2.min.js') }}"></script>
    <script src="{{ asset('assets/libs/bootstrap-datepicker/js/bootstrap-datepicker.min.js') }}"></script>

    <script src="{{ asset('js/pages/add_invoice.js') }}"></script>
    <script src="{{ asset('js/pages/form-repeater.int.js') }}"></script>

    <script>

        $(document).ready(function () {
            window.initSelectCompanyDrop = () =>

            {
                $('#selectprovider').select2({
                    placeholder: 'choisir le fournisseur',
                    allowClear: true
                });

            }
            initSelectCompanyDrop();

            window.livewire.on('select2', () => {
                initSelectCompanyDrop();
            });

        });

    </script>

@endpush

@endonce