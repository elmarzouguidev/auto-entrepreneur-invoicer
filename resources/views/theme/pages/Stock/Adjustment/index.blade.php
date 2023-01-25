@extends('theme.layouts.app')

@section('content')
    <div class="container-fluid">

        @include('theme.pages.Stock.Adjustment.__title')

        {{-- @include('theme.pages.Stock.Adjustment.__table') --}}

        @livewire('stock.adjustment.adjustments', ['adjustments' => $adjustments, 'warehouses' => $warehouses, 'products' => $products])

        @include('theme.pages.Stock.Adjustment.__add_adjustment_modal')

        @each('theme.pages.Stock.Adjustment.__details', $adjustments, 'adjustment')

        @each('theme.pages.Stock.Adjustment.__history', $adjustments, 'adjustment')

    </div>
@endsection

@section('css')
    <!-- DataTables -->
    <link href="{{ asset('assets/libs/datatables.net-bs4/css/dataTables.bootstrap4.min.css') }}" rel="stylesheet"
        type="text/css" />
    <link href="{{ asset('assets/libs/datatables.net-buttons-bs4/css/buttons.bootstrap4.min.css') }}" rel="stylesheet"
        type="text/css" />

    <!-- Responsive datatable examples -->
    <link href="{{ asset('assets/libs/datatables.net-responsive-bs4/css/responsive.bootstrap4.min.css') }}" rel="stylesheet"
        type="text/css" />

    <link href="{{ asset('assets/libs/select2/css/select2.min.css') }}" rel="stylesheet" type="text/css" />

    <link href="{{ asset('assets/libs/bootstrap-datepicker/css/bootstrap-datepicker.min.css') }}" rel="stylesheet"
        type="text/css">
@endsection

@push('scripts')
    <script src="{{ asset('assets/libs/jquery.repeater/jquery.repeater.min.js') }}"></script>

    <script src="{{ asset('assets/libs/datatables.net/js/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('assets/libs/datatables.net-bs4/js/dataTables.bootstrap4.min.js') }}"></script>

    <script src="{{ asset('assets/libs/datatables.net-buttons/js/dataTables.buttons.min.js') }}"></script>
    <script src="{{ asset('assets/libs/datatables.net-buttons-bs4/js/buttons.bootstrap4.min.js') }}"></script>
    <script src="{{ asset('assets/libs/jszip/jszip.min.js') }}"></script>
    <script src="{{ asset('assets/libs/pdfmake/build/pdfmake.min.js') }}"></script>
    <script src="{{ asset('assets/libs/pdfmake/build/vfs_fonts.js') }}"></script>
    <script src="{{ asset('assets/libs/datatables.net-buttons/js/buttons.html5.min.js') }}"></script>
    <script src="{{ asset('assets/libs/datatables.net-buttons/js/buttons.print.min.js') }}"></script>
    <script src="{{ asset('assets/libs/datatables.net-buttons/js/buttons.colVis.min.js') }}"></script>

    <script src="{{ asset('assets/libs/datatables.net-responsive/js/dataTables.responsive.min.js') }}"></script>
    <script src="{{ asset('assets/libs/datatables.net-responsive-bs4/js/responsive.bootstrap4.min.js') }}"></script>

    <script src="{{ asset('js/pages/datatables.init.js') }}"></script>

    <script src="{{ asset('assets/libs/select2/js/select2.min.js') }}"></script>

    <script src="{{ asset('assets/libs/bootstrap-datepicker/js/bootstrap-datepicker.min.js') }}"></script>

    <script src="{{ asset('js/pages/form-repeater.int.js') }}"></script>

    <script>
        /*********************************************/
        $(".select2").select2({
            width: '100%'
        });
    </script>
@endpush
@push('reloadModal')
    <script>
        window.addEventListener('hidden.bs.modal', event => {

            window.location.reload();
        });
    </script>
@endpush