<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-body">
                <form method="post" action="{{ route('commercial:products.update', $product->uuid) }}"
                    enctype="multipart/form-data">
                    @csrf
                    <div class="row">
                        <div class="col-6">
                            <div class="row mb-4">
                                <label for="name" class="col-form-label col-lg-3">Nom *</label>
                                <div class="col-lg-9">
                                    <input id="name" name="name" type="text"
                                        class="form-control @error('name') is-invalid @enderror"
                                        value="{{ $product->name }}" required>
                                    @error('name')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="row mb-3">

                                <label class="col-lg-3 form-label">Tax *</label>
                                <div class="col-lg-9">
                                    <select name="taxe"
                                        class="form-control select2-templating @error('taxe') is-invalid @enderror"
                                        required>
                                        <option value="">Choisir la tax</option>
                                        @foreach ($taxes as $taxe)
                                            <option {{ $product->tax?->id === $taxe->id ? 'selected' : '' }}
                                                value="{{ $taxe->id }}">
                                                {{ $taxe->taux_percent }} ( {{ $taxe->name }} )
                                            </option>
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

                                <label class="col-lg-3 form-label">Unité *</label>
                                <div class="col-lg-9">
                                    <select name="unite"
                                        class="form-control select2-templating @error('unite') is-invalid @enderror"
                                        required>
                                        <option value="">Choisir l'unité</option>
                                        @foreach ($unites as $unite)
                                            <option {{ $product->unite?->id === $unite->id ? 'selected' : '' }}
                                                value="{{ $unite->id }}">{{ $unite->name }}</option>
                                        @endforeach
                                    </select>
                                    @error('unite')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>

                            </div>
                            <div class="row mb-4">
                                <label for="price_buy" class="col-form-label col-lg-3">Prix d'achat *</label>
                                <div class="col-lg-9">
                                    <input id="price_buy" name="price_buy" type="text"
                                        class="form-control @error('price_buy') is-invalid @enderror"
                                        value="{{ $product->price_buy }}">
                                    @error('price_buy')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="row mb-4">
                                <label for="price_sell" class="col-form-label col-lg-3">Prix de vent *</label>
                                <div class="col-lg-9">
                                    <input id="price_sell" name="price_sell" type="text"
                                        class="form-control @error('price_sell') is-invalid @enderror"
                                        value="{{ $product->price_sell }}">
                                    @error('price_sell')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="row mb-4">
                                <label for="sku" class="col-form-label col-lg-3">SKU *</label>
                                <div class="col-lg-9">
                                    <input id="sku" name="sku" type="text"
                                        class="form-control @error('sku') is-invalid @enderror"
                                        value="{{ $product->sku }}" required>
                                    @error('sku')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="col-6">

                            <div class="row mb-3">

                                <label class="col-lg-3 form-label">Catégorie</label>
                                <div class="col-lg-9">
                                    <select name="category"
                                        class="form-control select2-templating @error('category') is-invalid @enderror">
                                        <option value="">Choisir la Catégorie</option>
                                        @foreach ($categories as $category)
                                            <option {{ $product->category?->id === $category->id ? 'selected' : '' }}
                                                value="{{ $category->id }}">{{ $category->name }}</option>
                                        @endforeach
                                    </select>
                                    @error('category')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>

                            </div>
                            <div class="row mb-3">

                                <label class="col-lg-3 form-label">Marque</label>
                                <div class="col-lg-9">
                                    <select name="brand"
                                        class="form-control select2-templating @error('brand') is-invalid @enderror">
                                        <option value="">Choisir la Marque</option>
                                        @foreach ($brands as $brand)
                                            <option {{ $product->brand?->id === $brand->id ? 'selected' : '' }}
                                                value="{{ $brand->id }}">{{ $brand->name }}</option>
                                        @endforeach
                                    </select>
                                    @error('brand')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>

                            </div>
                            <div class="row mb-4">
                                <label for="description" class="col-form-label col-lg-3">Description </label>
                                <div class="col-lg-9">
                                    <textarea class="form-control @error('description') is-invalid @enderror" id="description" name="description"
                                        rows="7">{{ $product->description }}</textarea>
                                    @error('description')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label class="col-form-label col-lg-3"></label>
                                @php
                                    $url = $product->getFirstMediaUrl('products_photos', 'normal');
                                    
                                @endphp
                                <div class="col-lg-9">
                                    <a class="image-popup-no-margins" href="{{ $url }}">
                                        <img class="img-fluid" alt="" src="{{ $url }}"
                                            width="50%">
                                    </a>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label class="col-form-label col-lg-3"></label>
                                <div class="col-lg-9">
                                    <input class="form-control @error('photo') is-invalid @enderror" name="photo"
                                        type="file" accept="image/*" />
                                    @error('photo')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>


                            </div>

                        </div>
                    </div>
                    <div class="row mb-3">

                        <div class="col-lg-10">
                            <button type="submit" class="btn btn-block btn-primary">Modifier</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
