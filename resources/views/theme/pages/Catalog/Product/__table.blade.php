<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-body">
                <div class="row">
                    <div class="col-12 mb-4">
                        <button class="btn btn-info" type="button" class="btn btn-info  btn-sm" data-bs-toggle="modal"
                            data-bs-target=".addProductModal">
                            Ajouter un Produit
                        </button>

                    </div>
                </div>

                @include('theme.layouts._parts.__messages')

                <table id="datatable-buttons" class="table table-bordered dt-responsive nowrap w-100">
                    <thead>
                        <tr>
                            <th>Image</th>
                            <th>SKU</th>
                            <th>Nom</th>
                            <th>Prix d'achat</th>
                            <th>Prix de vent</thNom>
                            <th>TAXE</th>
                            <th>Montant Taxe</th>
                            <th>Montant TTC</th>
                            <th>Quantité</th>
                            <th>Unité</th>
                            <th>Catégorie</th>
                            <th>Marque</th>
                            <th>Action</th>
                        </tr>
                    </thead>

                    <tbody>

                        @foreach ($products as $product)
                            <tr>
                                <td>
                                    <div>
                                        @php
                                            $url = $product->getFirstMediaUrl('products_photos', 'normal');
                                            
                                        @endphp

                                        <a class="image-popup-no-margins" href="{{ $url }}">
                                            <img class="img-fluid" alt="" src="{{ $url }}"
                                                width="50">
                                        </a>

                                    </div>

                                </td>
                                <td> {{ $product->sku }}</td>
                                <td> {{ $product->name }}</td>
                                <td>
                                    {{ $product->price_buy }} DH
                                </td>
                                <td>
                                    {{ $product->price_sell }} DH
                                </td>
                                <td>
                                    {{ $product->tax?->taux_percent }}
                                </td>
                                <td>
                                    {{ $product->price_tax }} DH
                                </td>
                                <td>
                                    {{ $product->price_sell_total }} DH
                                </td>
                                <td>
                                    {{ $product->total_qte }}
                                </td>

                                <td>
                                    {{ $product->unite?->name }}
                                </td>
                                <td>
                                    {{ $product->category?->name }}
                                </td>
                                <td>
                                    {{ $product->brand?->name }}
                                </td>
                                <td>
                                    <div class="d-flex gap-3">

                                        <a href="{{ route('commercial:products.edit', $product->uuid) }}"
                                            class="btn btn-info btn-sm">
                                            Editer
                                        </a>
                                        <button class="btn btn-danger btn-sm" type="button"
                                            onclick="
                                                var result = confirm('Are you sure you want to delete this product ?');

                                                if(result){
                                                    event.preventDefault();
                                                    document.getElementById('delete-prod-{{ $product->uuid }}').submit();
                                                }">
                                            Supprimer
                                        </button>
                                    </div>
                                </td>
                                <form id="delete-prod-{{ $product->uuid }}" method="post"
                                    action="{{ route('commercial:products.delete') }}">
                                    @csrf
                                    @method('DELETE')
                                    <input type="hidden" name="productId" value="{{ $product->uuid }}">
                                </form>
                            </tr>
                        @endforeach

                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
