<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-body">
                <form method="post" action="{{ route('buy:invoices.update', $invoice->uuid) }}"
                    enctype="multipart/form-data">
                    @csrf
                    <div class="row">
                        <div class="col-6">
                            <div class="row mb-4">
                                <label for="code" class="col-form-label col-lg-4">Numéro de FACTURE *</label>
                                <div class="col-lg-8">
                                    <input id="code" name="code" type="text"
                                        class="form-control @error('code') is-invalid @enderror"
                                        value="{{ $invoice->code }}" required>
                                    @error('code')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="row mb-4">
                                <label for="price_ht" class="col-form-label col-lg-4">Montant HT *</label>
                                <div class="col-lg-8">
                                    <input id="price_ht" name="price_ht" type="text"
                                        class="form-control @error('name') is-invalid @enderror"
                                        value="{{ $invoice->price_ht }}" required>
                                    @error('price_ht')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="row mb-3">

                                <label class="col-lg-4 form-label">Taxe *</label>
                                <div class="col-lg-8">
                                    <select name="taxe"
                                        class="form-control select2-templating @error('taxe') is-invalid @enderror"
                                        required>

                                        @foreach ($taxes as $taxe)
                                            <option {{ $invoice->taxe?->id === $taxe->id ? 'selected' : '' }}
                                                value="{{ $taxe->id }}">

                                                {{ $taxe->taux_percent }} ({{ $taxe->name }} )

                                            </option>
                                        @endforeach
                                    </select>
                                    @error('taxe')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>

                            </div>

                            <div class="row mb-3">

                                <label class="col-lg-4 form-label">Fournisseur *</label>
                                <div class="col-lg-8">
                                    <select name="provider"
                                        class="form-control select2-templating @error('provider') is-invalid @enderror"
                                        required>

                                        @foreach ($providers as $provider)
                                            <option {{ $invoice->provider?->id === $provider->id ? 'selected' : '' }}
                                                value="{{ $provider->id }}">
                                                {{ $provider->entreprise }}
                                            </option>
                                        @endforeach
                                    </select>
                                    @error('provider')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>

                            </div>

                        </div>
                        <div class="col-6">
                            <div class="row mb-3 mt-3">
                                <label class="col-lg-4 form-label">Date de facture *</label>
                                <div class="col-lg-8">
                                    <div class="input-group" id="datepicker1">
                                        <input type="text" name="invoice_date"
                                            class="form-control @error('invoice_date') is-invalid @enderror"
                                            data-date-format="yyyy-mm-dd"
                                            value="{{ $invoice->invoice_date->format('Y-m-d') }}"
                                            data-date-container='#datepicker1' data-provide="datepicker">

                                        <span class="input-group-text"><i class="mdi mdi-calendar"></i></span>
                                        @error('invoice_date')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            <div class="row mb-4">
                                <label for="notes" class="col-form-label col-lg-4">Note </label>
                                <div class="col-lg-8">
                                    <textarea class="form-control @error('notes') is-invalid @enderror" id="notes" name="description" rows="4">{{ $invoice->condition_general }}</textarea>
                                    @error('notes')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label class="col-form-label col-lg-4">Fichier *</label>
                                <div class="col-lg-8">
                                    <input class="form-control @error('invoice_file') is-invalid @enderror"
                                        name="invoice_file" type="file" />
                                    @error('invoice_file')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror

                                </div>

                            </div>
                        </div>
                        <div class="row mb-3">
                            <label class="col-form-label col-lg-2"></label>
                            <div class="col-lg-10">
                                <button type="submit" class="btn btn-block btn-primary">Update</button>
                            </div>
                        </div>
                    </div>

                </form>
            </div>
        </div>
    </div>
</div>
