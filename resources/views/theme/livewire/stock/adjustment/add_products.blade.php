<form class="repeater" method="post" action="">
    <div data-repeater-list="productsnew">
        <div data-repeater-item class="row">
            <div class="mb-3 col-lg-4">
                <label for="product">Produit *</label>
                <select wire:model="product" name="product" class="form-control select2-templating @error('product') is-invalid @enderror"
                    required>
                    <option value="">Choisir le produit</option>
                    @foreach ($products as $product)
                        <option value="{{ $product->id }}">{{ $product->name }}</option>
                    @endforeach
                </select>
                @error('products.*.product')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>

            <div class="mb-3 col-lg-2">
                <label for="qte">{{ __('invoice.form.article_qte') }} *</label>
                <input wire:model="qte" type="number" name="qte" id="qte"
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

                <button title="ajouter un produit" wire:click="addProduct('{{$adjustment->uuid}}')" type="button"
                    class="mt-4 btn btn-info waves-effect waves-light">

                    <i class="fas fa-edit font-size-16"></i>
                </button>

            </div>
        </div>

    </div>
</form>
