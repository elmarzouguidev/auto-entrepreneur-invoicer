<div class="col-xl-12">
    <div class="card ">
        <div class="card-body">
            <div class="row">
                <div class="col-xl-6">
                    <div class="button-items">
                        <div class="btn-group">
                            <button type="button" class="btn btn-primary" id="select_periode">Choisir la période</button>
                            <button type="button" class="btn btn-primary dropdown-toggle dropdown-toggle-split"
                                data-bs-toggle="dropdown" aria-expanded="false">
                                <i class="mdi mdi-chevron-down"></i>
                            </button>

                            <div class="dropdown-menu dropup ">
                                <a class="dropdown-item {{ in_array('1', explode(',', request()->input('trimestre'))) ? 'text-danger selected-filter' : '' }}"
                                    href="?appFilter[GetPeriod]=1 &trimestre=1"> Trimestre 1</a>
                                <a class="dropdown-item {{ in_array('2', explode(',', request()->input('trimestre'))) ? 'text-danger selected-filter' : '' }}"
                                    href="?appFilter[GetPeriod]=2 &trimestre=2">Trimestre 2</a>
                                <a class="dropdown-item {{ in_array('3', explode(',', request()->input('trimestre'))) ? 'text-danger selected-filter' : '' }}"
                                    href="?appFilter[GetPeriod]=3 &trimestre=3">Trimestre 3</a>
                                <a class="dropdown-item {{ in_array('4', explode(',', request()->input('trimestre'))) ? 'text-danger selected-filter' : '' }}"
                                    href="?appFilter[GetPeriod]=4 &trimestre=4">Trimestre 4</a>

                                <a class="dropdown-item {{ in_array('true', explode(',', request()->input('currentYear'))) ? 'text-danger selected-filter' : '' }}"
                                    href="?appFilter[DateBetween]={{ now()->startOfYear()->format('Y-m-d') }},{{ now()->endOfYear()->format('Y-m-d') }} &currentYear=true">
                                    Année
                                    en cours
                                </a>
                                <a class="dropdown-item {{ in_array('true', explode(',', request()->input('lastYear'))) ? 'text-danger selected-filter' : '' }}"
                                    href="?appFilter[DateBetween]={{ now()->subYear()->startOfYear()->format('Y-m-d') }},{{ now()->subYear()->endOfYear()->format('Y-m-d') }} &lastYear=true">Année
                                    précédente</a>
                                <a class="dropdown-item {{ in_array('true', explode(',', request()->input('last7Days'))) ? 'text-danger selected-filter' : '' }}"
                                    href="?appFilter[DateBetween]={{ now()->subDays(6)->format('Y-m-d') }},{{ now()->format('Y-m-d') }} &last7Days=true">Les
                                    7 derniers jours</a>
                                <a class="dropdown-item {{ in_array('true', explode(',', request()->input('last30Days'))) ? 'text-danger selected-filter' : '' }}"
                                    href="?appFilter[DateBetween]={{ now()->subDays(30)->format('Y-m-d') }},{{ now()->format('Y-m-d') }} &last30Days=true">Les
                                    30 derniers jours</a>
                                <a class="dropdown-item {{ in_array('true', explode(',', request()->input('lastMonth'))) ? 'text-danger selected-filter' : '' }}"
                                    href="?appFilter[DateBetween]={{ now()->startOfMonth()->format('Y-m-d') }},{{ now()->endOfMonth()->format('Y-m-d') }} &lastMonth=true">Ce
                                    mois-ci</a>
                                <a class="dropdown-item {{ in_array('true', explode(',', request()->input('oldMonth'))) ? 'text-danger selected-filter' : '' }}"
                                    href="?appFilter[DateBetween]={{ now()->subMonth()->startOfMonth()->format('Y-m-d') }},{{ now()->subMonth()->endOfMonth()->format('Y-m-d') }} &oldMonth=true">Le
                                    mois dernier
                                </a>

                            </div>
                        </div>
                    </div>
                </div>
                @if (request()->input('appFilter.DateBetween'))
                    @php
                        $dates = explode(',', request()->input('appFilter.DateBetween'));
                    @endphp
                @endif
                <div class="col-xl-6">
                    <div class="row">
                        {{-- <div class="col-xl-3 mt-2">
                            <label>Filtre par date</label>
                        </div> --}}
                        <div class="col-xl-10">
                            <div class="input-daterange input-group" id="datepicker6" data-date-format="yyyy-mm-dd"
                                data-date-autoclose="true" data-provide="datepicker" data-date-container='#datepicker6'>
                                <input type="text" class="form-control" name="start" id="filterDateStart"
                                    placeholder="Indiquez une date de début" value="{{ $dates[0] ?? '' }}" />
                                <input type="text" class="form-control" name="end" id="filterDateEnd"
                                    placeholder="Indiquez une date de fin" value="{{ $dates[1] ?? '' }}" />
                            </div>

                        </div>
                        <div class="col-xl-2"">

                            <button type="submit" id="filterData" class="btn btn-primary">
                                Filter
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
