<div class="col-xl-12">
    <div class="row">
        <div class="col-xl-6">
            <div class="card">
                <div class="card-body">
                    <div class="d-sm-flex flex-wrap">

                        <h4 class="card-title mb-4">{{ $chart->options['chart_title'] }}</h4>

                        {!! $chart->renderHtml() !!}
                    </div>

                    {{-- <div id="stacked-column-chart" class="apex-charts" dir="ltr"></div> --}}
                </div>
            </div>
        </div>
        <div class="col-xl-6">
            <div class="card">
                <div class="card-body">
                    <div class="d-sm-flex flex-wrap">

                        <h4 class="card-title mb-4">{{ $chart2->options['chart_title'] }}</h4>

                        {!! $chart2->renderHtml() !!}
                    </div>

                    {{-- <div id="stacked-column-chart" class="apex-charts" dir="ltr"></div> --}}
                </div>
            </div>
        </div>
    </div>
</div>
