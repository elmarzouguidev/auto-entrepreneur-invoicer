<div class="row">
    <div class="col-lg-12">
        <div class="mb-4">
            <label class="form-label">Montant reçu *</label>

            <input type="text" name="price_total" class="form-control @error('price_total') is-invalid @enderror"
                value="{{ $invoice->formated_price_total }}" max="{{ $invoice->price_total }}" readonly>
            @error('price_total')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror

        </div>
    </div>
    <div class="col-lg-12">
        <div class="mb-4">
            <label class="form-label">Date de règlement *</label>


            <input type="date" name="bill_date" class="form-control @error('bill_date') is-invalid @enderror"
                value="{{ now()->format('d-m-Y') }}" required pattern="[0-9]{4}-[0-9]{2}-[0-9]{2}">

            @error('bill_date')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror


        </div>
    </div>
    {{-- <div class="col-lg-12">
        <div class="mb-4">
            <label class="form-label">Mode de règlement *</label>

            <select name="bill_mode" class="form-select @error('bill_mode') is-invalid @enderror">
                <option value="Espèce">Espèce</option>
                <option value="Virement">Virement</option>
                <option value="Chèque">Chèque</option>
            </select>
            @error('bill_mode')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror

        </div>
    </div> --}}
</div>
<div class="docs-options">
    <label class="form-label">Référence de transaction</label>
    <div class="input-group mb-4">

        <input type="text" class="form-control @error('reference') is-invalid @enderror" name="reference"
            value="" aria-describedby="ref" placeholder="exemple : CHEQUE N° 4552154221">
        @error('reference')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
        @enderror
    </div>
</div>
