<div class="row">

    <div class="col-lg-12">
        <div class="mb-4">
            <label class="form-label">Client *</label>
            <select name="client" class="form-control @error('client') is-invalid @enderror" readonly>
                <option
                    value="{{ optional($estimate->client)->id }}">{{ optional($estimate->client)->entreprise }}</option>
            </select>
            @error('client')
            <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror

        </div>
    </div>
</div>
