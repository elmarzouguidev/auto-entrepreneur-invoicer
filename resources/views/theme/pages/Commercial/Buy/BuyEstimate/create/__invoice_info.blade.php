<div class="row">
    <div class="col-6">
        <div class="row mb-4">
            <label for="name" class="col-form-label col-lg-3">Fournisseur *</label>
            <div class="col-lg-9">
                <select name="provider" class="form-control select2-templating @error('provider') is-invalid @enderror"
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
        <div class="row mb-3">

            <label class="col-lg-3 form-label">Taxe </label>
            <div class="col-lg-9">
                <select name="taxe" class="form-control select2-templating @error('taxe') is-invalid @enderror"
                    required>
                    <option value="">Choisir la taxe</option>
                    @foreach ($taxes as $taxe)
                        <option value="{{ $taxe->id }}">{{ $taxe->taux_percent }} ( {{ $taxe->name }} )</option>
                    @endforeach
                </select>
                @error('taxe')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>

        </div>

        <div class="row mb-4">
            <label for="price_total" class="col-form-label col-lg-3">Montant TOTAL *</label>
            <div class="col-lg-9">
                <input id="price_total" name="price_total" type="text"
                    class="form-control @error('price_total') is-invalid @enderror" placeholder="Entrer le montant TOTAL">
                @error('price_total')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
        </div>
    </div>
    <div class="col-6">

        <div class="row mb-4">
            <label for="description" class="col-form-label col-lg-3">Notes </label>
            <div class="col-lg-9">
                <textarea class="form-control @error('description') is-invalid @enderror" id="description" name="description"
                    rows="4" placeholder="Entrer la discription du produit "></textarea>
                @error('description')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
        </div>

        <div class="row mb-3">
            <label class="col-form-label col-lg-3">Fichier *</label>
            <div class="col-lg-9">
                <input class="form-control @error('file') is-invalid @enderror" name="file" type="file"
                    accept="image/*" required />
                @error('photo')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>

        </div>
    </div>
</div>
