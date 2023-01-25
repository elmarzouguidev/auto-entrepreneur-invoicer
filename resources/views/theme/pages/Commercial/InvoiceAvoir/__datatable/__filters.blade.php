<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-body">
                <h5 class="card-title mb-4">Filters</h5>

                <form class="row gy-2 gx-3 align-items-center">

                    <div class="col-lg-2 col-md-2">
                        <label class="visually-hidden" for="clienter">Client</label>
                        <select class="form-select select2" id="clienter">
                            <option selected value="">Client</option>
                            @foreach ($clients as $client)
                                <option value="{{ $client->id }}"
                                    {{ in_array($client->id, explode(',', request()->input('appFilter.GetClient'))) ? 'selected' : '' }}>

                                    {{ $client->entreprise }}
                                </option>
                            @endforeach

                        </select>
                    </div>
                    <div class="col-lg-2 col-md-2">

                        <div class="input-group" id="datepicker1">
                            <input type="text" name="invoice_date" id="filterDate" disabled
                                class="form-control @error('invoice_date') is-invalid @enderror"
                                value="{{ request()->input('appFilter.GetInvoiceAvoirDate') }}"
                                data-date-format="dd-mm-yyyy" data-date-container='#datepicker1'
                                data-provide="datepicker" placeholder="Date">

                            <span class="input-group-text"><i class="mdi mdi-calendar"></i></span>
                            @error('invoice_date')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>
                    @if (request()->input('appFilter.DateBetween'))
                        @php
                            $dates = explode(',', request()->input('appFilter.DateBetween'));
                        @endphp
                    @endif
                    <div class="col-xl-5">
                        <div class="row">
                            {{-- <div class="col-xl-3 mt-2">
                        <label>Filtre par date</label>
                    </div> --}}
                            <div class="col-xl-10">
                                <div class="input-daterange input-group" id="datepicker6" data-date-format="yyyy-mm-dd"
                                    data-date-autoclose="true" data-provide="datepicker"
                                    data-date-container='#datepicker6'>
                                    <input type="text" class="form-control" name="start" id="filterDateStart"
                                        placeholder="Indiquez une date de début" value="{{ $dates[0] ?? '' }}" />
                                    <input type="text" class="form-control" name="end" id="filterDateEnd"
                                        placeholder="Indiquez une date de fin" value="{{ $dates[1] ?? '' }}" />
                                </div>

                            </div>
                        </div>
                    </div>
                    <div class="col-sm-auto">
                        <button type="submit" id="filterData" class="btn btn-primary w-md">filter</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
