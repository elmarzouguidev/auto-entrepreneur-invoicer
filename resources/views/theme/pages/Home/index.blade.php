@extends('theme.layouts.app')

@section('content')
    <div class="container-fluid">

        @include('theme.pages.Home.sections.section_0_page_title')

        @hasanyrole('SuperAdmin|Admin')
            <div class="row">

                @include('theme.pages.Home.sections.section_a_period')

            </div>

            <div class="row">

                @include('theme.pages.Home.sections.section_b_b')

            </div>
        @endhasanyrole

        @hasanyrole('SuperAdmin|Admin')
            <div class="row">

                @include('theme.pages.Home.sections.section_a_chart')

            </div>

            <div class="row">

                @include('theme.pages.Home.sections.section_c_c')

            </div>
            <div class="row">

                @include('theme.pages.Home.sections.section_a_chart_tow')

            </div>

            @include('theme.pages.Home.sections.section_dd')
        @endhasanyrole

    </div>
@endsection

@section('css')
    <link href="{{ asset('assets/libs/bootstrap-datepicker/css/bootstrap-datepicker.min.css') }}" rel="stylesheet"
        type="text/css">
@endsection

@push('scripts')
    <script src="{{ asset('assets/libs/bootstrap-datepicker/js/bootstrap-datepicker.min.js') }}"></script>

    {!! $chart->renderChartJsLibrary() !!}
    {!! $chart->renderJs() !!}

    {!! $chart3->renderChartJsLibrary() !!}
    {!! $chart3->renderJs() !!}


    {!! $chart4->renderChartJsLibrary() !!}
    {!! $chart4->renderJs() !!}

    {!! $chart5->renderChartJsLibrary() !!}
    {!! $chart5->renderJs() !!}

    <script>
        function getDateFilter() {
            let startDate = document.getElementById("filterDateStart");
            let endDate = document.getElementById("filterDateEnd");
            console.log(startDate.value, "##", endDate.value);
            return [startDate.value, endDate.value];
        }

        function filterResults() {


            let getDate = getDateFilter();
            // console.log(clientId);

            let href = '{{ collect(request()->segments())->last() }}?';

            if (getDate.length) {
                href += '&appFilter[DateBetween]=' + getDate;
            }
            document.location.href = href;
            // return href;
        }

        document.getElementById("filterData").addEventListener("click", function(event) {

            event.preventDefault();
            filterResults();

            /*$.ajax({
                url: filterResults(),
                type: 'GET',
                success: function() {
                    console.log("it Works");
                    $("#invoices_lister").load(window.location.href + " #invoices_lister");
                }
            });*/
        });

        /*$(".chk-filter").on("click", function() {
            if (this.checked) {
               // $('#filter').click();
                filterResults()
            }
        });*/
    </script>
@endpush
