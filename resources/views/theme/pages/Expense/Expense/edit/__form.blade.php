<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-body">
                <form method="post" action="{{ route('expense:invoices.update', $invoice->uuid) }}"
                    enctype="multipart/form-data">
                    @csrf
                    <div class="row">
                        <div class="col-6">
                            <div class="row mb-4">
                                <label for="price_ht" class="col-form-label col-lg-4">Montant HT *</label>
                                <div class="col-lg-8">
                                    <input id="price_ht" name="price_ht" type="text"
                                        class="form-control @error('price_ht') is-invalid @enderror"
                                        value="{{ $invoice->price_ht }}" required>
                                    @error('price_ht')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="row mb-3">

                                <label class="col-lg-4 form-label">Catégorie *</label>
                                <div class="col-lg-8">
                                    <select name="category"
                                        class="form-control select2-templating @error('category') is-invalid @enderror"
                                        required>
                                        @foreach ($categories as $category)
                                            <option value="{{ $category->id }}"
                                                {{ $invoice->category?->id === $category->id ? 'selected' : '' }}>
                                                {{ $category->name }}</option>
                                        @endforeach
                                    </select>
                                    @error('category')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>

                            </div>
                            <div class="row mb-3">

                                <label class="col-lg-4 form-label">Devise *</label>
                                <div class="col-lg-8">
                                    <select name="currency"
                                        class="form-control select2-templating @error('currency') is-invalid @enderror"
                                        required>

                                        @foreach ($currencies as $currency)
                                            <option {{ $currency->default == true ? 'selected' : '' }}
                                                value="{{ $currency->id }}"> {{ $currency->name }}</option>
                                        @endforeach
                                    </select>
                                    @error('currency')
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
                                            <option value="{{ $taxe->id }}"
                                                {{ $invoice->taxe?->id === $taxe->id ? 'selected' : '' }}>
                                                {{ $taxe->taux_percent }} (
                                                {{ $taxe->name }} )</option>
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
                                        <option value="">Choisir le fournisseur</option>
                                        @foreach ($providers as $provider)
                                            <option value="{{ $provider->id }}"
                                                {{ $invoice->provider?->id === $provider->id ? 'selected' : '' }}>
                                                {{ $provider->entreprise }}</option>
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
                            <div class="row mb-4">
                                <label for="reference" class="col-form-label col-lg-4">Référence</label>
                                <div class="col-lg-8">
                                    <input id="reference" name="reference" type="text"
                                        class="form-control @error('reference') is-invalid @enderror"
                                        value="{{ $invoice->reference }}">
                                    @error('reference')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="row mb-3 mt-3">
                                <label class="col-lg-4 form-label">Date de dépense *</label>
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
                                <label for="note" class="col-form-label col-lg-4">Note </label>
                                <div class="col-lg-8">
                                    <textarea class="form-control @error('note') is-invalid @enderror" id="note" name="note" rows="4">{{ $invoice->note }}</textarea>
                                    @error('note')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label class="col-form-label col-lg-4">Fichier *</label>
                                <div class="col-lg-8">
                                    <input class="form-control @error('expense_file') is-invalid @enderror"
                                        name="expense_file" type="file" />
                                    @error('expense_file')
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
                                <button type="submit" class="btn btn-block btn-primary">update</button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
