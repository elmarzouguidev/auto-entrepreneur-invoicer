<div>
    @foreach ($orderProducts as $index => $orderProduct)
        <div class="row">
            <div class="mb-3 col-lg-3">
                <label for="designation">Désignation *</label>
                <textarea name="orderProducts[{{ $index }}][designation]" rows="3"
                    wire:model="orderProducts.{{ $index }}.designation"
                    class="form-control @error('orderProducts.' . $index . '.designation') is-invalid @enderror">{{ old('orderProducts.' . $index . '.designation') }}</textarea>
                @error('orderProducts.' . $index . '.designation')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
            <div class="mb-3 col-lg-3">
                <label for="product">Produit *</label>
                <select wire:ignore class="form-control select2" name="orderProducts[{{ $index }}][product_id]"
                    data-indexer="{{ $index }}" wire:model="orderProducts.{{ $index }}.product_id"
                    {{ $orderProducts[$index]['readonly'] }} required>
                    <option value=""></option>
                    <optgroup label="Produits">
                        @foreach ($products as $product)
                            <option value="{{ $product->id }}">
                                {{ $product->name }}
                            </option>
                        @endforeach
                    </optgroup>
                </select>

                @error('orderProducts.product_id')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>

            <div class="mb-3 col-lg-1">
                <label for="quantity">{{ __('invoice.form.article_qte') }} *</label>
                <input type="number" name="orderProducts[{{ $index }}][quantity]" min="1"
                    wire:model="orderProducts.{{ $index }}.quantity"
                    class="form-control @error('articles.*.quantity') is-invalid @enderror" required />

                @error('orderProducts.quantity')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>

            <div class="mb-3 col-lg-2">
                <label for="prix_unitaire">Prix UNI *</label>
                <input type="text" name="orderProducts[{{ $index }}][prix_unitaire]"
                    wire:model="orderProducts.{{ $index }}.prix_unitaire" {{-- wire:click="getPrice({{ $index }})" --}}
                    class="form-control @error('articles.*.prix_unitaire') is-invalid @enderror" value=""
                    required />

                @error('prix_unitaire')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
            <div class="mb-3 col-lg-1">
                <label for="remise">{{ __('Remise %') }} </label>
                <input type="number" name="orderProducts[{{ $index }}][remise]" id="remise" value="0"
                    min="0" wire:model="orderProducts.{{ $index }}.remise"
                    class="form-control @error('articles.*.remise') is-invalid @enderror" />
                @error('remise')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
            <div class="mb-3 col-lg-1">
                <label for="prix_total">Montant HT</label>
                <input type="text" name="orderProducts[{{ $index }}][prix_total]"
                    wire:model="orderProducts.{{ $index }}.prix_total" {{-- wire:click="getPrice({{ $index }})" --}}
                    class="form-control @error('articles.*.prix_total') is-invalid @enderror" readonly />

                @error('prix_total')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>

            <div class="mb-3 col-lg-1">

                <button wire:click.prevent="removeProduct({{ $index }})" type="button"
                    class="mt-4 btn btn-danger waves-effect waves-light">
                    <i class="fas fa-trash-alt font-size-16"></i>
                </button>

            </div>
        </div>
    @endforeach
    <button wire:click.prevent="addProduct" title="Ajouter un produit a la facture" type="button"
        class="btn btn-primary waves-effect waves-light">
        <i class="bx bxs-plus-square font-size-16 align-middle"></i>
    </button>
</div>
