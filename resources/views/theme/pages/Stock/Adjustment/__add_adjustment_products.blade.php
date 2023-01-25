<div data-repeater-list="products">
    <div data-repeater-item class="row">
        <div class="mb-3 col-lg-4">
            <label for="product">Produit *</label>
            <select name="product_id" class="form-control select2-templating @error('product') is-invalid @enderror"
                required>
                <option value="">Choisir le produit</option>
                @foreach ($products as $product)
                    <option value="{{ $product->id }}">{{ $product->name }}</option>
                @endforeach
            </select>
            @error('products.*.product_id')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>

        <div class="mb-3 col-lg-3">
            <label for="qte">{{ __('invoice.form.article_qte') }} *</label>
            <input type="number" name="qte" id="qte"
                class="form-control @error('products.*.qte') is-invalid @enderror" required />
            @error('qte')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>
        <div class="mb-3 col-lg-4">
            <label for="qte">Type *</label>
            <select name="type"
                class="form-control select2-templating @error('products.*.type') is-invalid @enderror" required>
                <option value="">Type</option>

                <option value="add">Addition</option>
                <option value="sub">Soustraction</option>

            </select>
            @error('type')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>
        <div class="mb-3 col-lg-1">

            <button data-repeater-delete type="button" class="mt-4 btn btn-danger waves-effect waves-light">
                <i class="fas fa-trash-alt font-size-16"></i>
            </button>

        </div>
    </div>

</div>

<button data-repeater-create type="button" class="btn btn-success waves-effect waves-light">
    <i class="bx bx-check-double font-size-16 align-middle"></i>
</button>
