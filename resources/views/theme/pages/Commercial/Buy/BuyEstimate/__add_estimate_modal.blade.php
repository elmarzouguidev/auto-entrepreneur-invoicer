<div class="modal fade addEstimateModal " data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" role="dialog"
    aria-labelledby=orderdetailsModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl modal-dialog-scrollable" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id=orderdetailsModalLabel">Ajouter un DEVIS d'achat </h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">

                <form method="post" action="{{ route('buy:estimates.store') }}" enctype="multipart/form-data">
                    @csrf
                    <div class="row">
                        <div class="col-6">
                            <div class="row mb-4">
                                <label for="code" class="col-form-label col-lg-4">Numéro de devis *</label>
                                <div class="col-lg-8">
                                    <input id="code" name="code" type="text"
                                        class="form-control @error('code') is-invalid @enderror"
                                        placeholder="Entrer le numéro de DEVIS " required>
                                    @error('code')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="row mb-4">
                                <label for="price_ht" class="col-form-label col-lg-4">Montant HT*</label>
                                <div class="col-lg-8">
                                    <input id="price_ht" name="price_ht" type="text"
                                        class="form-control @error('name') is-invalid @enderror"
                                        placeholder="Entrer le Montant HT de DEVIS " required>
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
                                        <option value="">Choisir la taxe</option>
                                        @foreach ($taxes as $taxe)
                                            <option value="{{ $taxe->id }}">{{ $taxe->taux_percent }} (
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
                                            <option value="{{ $provider->id }}">{{ $provider->entreprise }}</option>
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
                                <label class="col-lg-4 form-label">Date de devis *</label>
                                <div class="col-lg-8">
                                    <div class="input-group" id="datepicker1">
                                        <input type="text" name="estimate_date"
                                            class="form-control @error('estimate_date') is-invalid @enderror"
                                            data-date-format="yyyy-mm-dd" value="{{ now()->format('Y-m-d') }}"
                                            data-date-container='#datepicker1' data-provide="datepicker">

                                        <span class="input-group-text"><i class="mdi mdi-calendar"></i></span>
                                        @error('estimate_date')
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
                                    <textarea class="form-control @error('notes') is-invalid @enderror" id="notes" name="description" rows="4"></textarea>
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
                                    <input class="form-control @error('estimate_file') is-invalid @enderror"
                                        name="estimate_file" type="file" required />
                                    @error('estimate_file')
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
                                <button type="submit" class="btn btn-block btn-primary">Ajouter</button>
                            </div>
                        </div>
                    </div>

                </form>

            </div>
        </div>
    </div>
</div>
