<div class="modal fade addProductModal " data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" role="dialog"
    aria-labelledby=orderdetailsModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl modal-dialog-scrollable" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id=orderdetailsModalLabel">Ajouter un Produit </h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">

                <form method="post" action="{{ route('commercial:products.store') }}" enctype="multipart/form-data">
                    @csrf
                    <div class="row">
                        <div class="col-6">
                            <div class="row mb-4">
                                <label for="name" class="col-form-label col-lg-3">Nom *</label>
                                <div class="col-lg-9">
                                    <input id="name" name="name" type="text"
                                        class="form-control @error('name') is-invalid @enderror"
                                        placeholder="Entrer le nom du produit " required>
                                    @error('name')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="row mb-3">

                                <label class="col-lg-3 form-label">Taxe *</label>
                                <div class="col-lg-9">
                                    <select name="taxe"
                                        class="form-control select2-templating @error('taxe') is-invalid @enderror"
                                        required>
                                        <option value="">Choisir la taxe</option>
                                        @foreach ($taxes as $taxe)
                                            <option value="{{ $taxe->id }}">{{ $taxe->taux_percent }} (
                                                {{ $taxe->name }} )</option>
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
                                            <option value="{{ $unite->id }}">{{ $unite->name }}</option>
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
                                        placeholder="Entrer le prix d'achat">
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
                                        placeholder="Entrer le prix de vent">
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
                                        placeholder="Entrer le sku " required>
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
                                            <option value="{{ $category->id }}">{{ $category->name }}</option>
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
                                            <option value="{{ $brand->id }}">{{ $brand->name }}</option>
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
                                        rows="7" placeholder="Entrer la discription du produit "></textarea>
                                    @error('description')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label class="col-form-label col-lg-3">Photo *</label>
                                <div class="col-lg-9">
                                    <input class="form-control @error('photo') is-invalid @enderror" name="photo"
                                        type="file" accept="image/*" required />
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
                        <label class="col-form-label col-lg-1"></label>
                        <div class="col-lg-10">
                            <button type="submit" class="btn btn-block btn-primary">Ajouter</button>
                        </div>
                    </div>
                </form>

            </div>
        </div>
    </div>

</div>
