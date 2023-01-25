<div class="col-xl-12">
    <div class="row">
        <div class="col-xl-6">
            <div class="card">
                <div class="card-body">
                    <div class="d-sm-flex flex-wrap">

                        <h4 class="card-title mb-4">{{ $chart4->options['chart_title'] }}</h4>

                        {!! $chart4->renderHtml() !!}
                    </div>

                    {{-- <div id="stacked-column-chart" class="apex-charts" dir="ltr"></div> --}}
                </div>
            </div>
        </div>
        <div class="col-xl-6">
            <div class="card">
                <div class="card-body">
                    <div class="d-sm-flex flex-wrap">

                        <h4 class="card-title mb-4">{{ $chart5->options['chart_title'] }}</h4>

                        {!! $chart5->renderHtml() !!}
                    </div>

                    {{-- <div id="stacked-column-chart" class="apex-charts" dir="ltr"></div> --}}
                </div>
            </div>
        </div>
    </div>
</div>
