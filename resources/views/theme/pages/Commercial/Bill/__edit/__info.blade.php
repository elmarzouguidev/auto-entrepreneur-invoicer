<div class="row">
    <div class="col-lg-12">
        <div class="mb-4">
            <label class="form-label">Client *</label>
            <input type="text" name="client" class="form-control @error('client') is-invalid @enderror"
            value="{{ optional($bill->billable->client)->entreprise }}" readonly>
            @error('client')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror

        </div>
    </div>
</div>
<div class="docs-options">
    <label class="form-label">Numéro de facture</label>
    <div class="input-group mb-4">

        <span class="input-group-text" id="invoice_prefix">
            {{ getDocument()->invoice_prefix }}
        </span>
        <input type="text" class="form-control @error('invoice_code') is-invalid @enderror" name="invoice_code"
            value="{{ optional($bill->billable)->code }}" aria-describedby="invoice_prefix" readonly>
        @error('invoice_code')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
        @enderror
    </div>
</div>
