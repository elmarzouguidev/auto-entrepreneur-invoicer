<div data-repeater-item class="row">
    <div class="mb-3 col-lg-4">
        <label for="product">Produit *</label>
        <select wire:model="product" name="product"
            class="form-control select2-templating @error('product') is-invalid @enderror" required>

            <option selected value="{{ $adjustProd->product?->id }}">
                {{ $adjustProd->product?->name }}
            </option>

        </select>
        @error('products.*.product_id')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
        @enderror
    </div>

    <div class="mb-3 col-lg-2">
        <label for="qte">{{ __('invoice.form.article_qte') }} *</label>
        <input wire:model="qte" type="number" name="qte" id="qte" value="{{ $adjustProd->qte }}"
            class="form-control @error('products.*.qte') is-invalid @enderror" required />
        @error('qte')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
        @enderror
    </div>
    <div class="mb-3 col-lg-4">
        <label for="qte">Type *</label>
        <select wire:model="type" name="type"
            class="form-control select2-templating @error('products.*.type') is-invalid @enderror" required>
            <option value="">Type</option>

            <option value="add" {{ $adjustProd->type === 'add' ? 'selected' : '' }}>Addition
            </option>
            <option value="sub" {{ $adjustProd->type === 'sub' ? 'selected' : '' }}>
                Soustraction</option>

        </select>
        @error('type')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
        @enderror
    </div>
    <div class="mb-3 col-lg-1">

        <button title="editer details" wire:click="updateDetail()" type="button"
            class="mt-4 btn btn-info waves-effect waves-light">

            <i class="fas fa-edit font-size-16"></i>
        </button>

    </div>
    <div class="mb-3 col-lg-1">

        <button wire:click="delete()" type="button" class="mt-4 btn btn-danger waves-effect waves-light">
            <i class="fas fa-trash-alt font-size-16"></i>
        </button>

    </div>
</div>
