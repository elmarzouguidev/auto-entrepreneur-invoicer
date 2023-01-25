<div class="row">

    <div class="col-lg-12" wire:ignore>
        <div class="mb-4">
            <label class="form-label">{{ __('invoice.form.client') }} *</label>

            <select name="client" id="selectclient" class="form-select @error('client') is-invalid @enderror" required>

                @if (isset($invoice))
                    <option selected value="{{ $invoice->client?->id }}">{{ $invoice->client?->entreprise }}
                    </option>
                @else
                    <option value="">Choisir</option>
                    @foreach ($clients as $client)
                        <option value="{{ $client->id }}">{{ $client->entreprise }}
                        </option>
                    @endforeach
                @endif

            </select>

            @error('client')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror

        </div>
    </div>

</div>
