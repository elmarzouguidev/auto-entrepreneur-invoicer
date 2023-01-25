<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-body">
                <div class="row">
                    <div class="col-12 mb-4">
                        <button class="btn btn-info" type="button" class="btn btn-info  btn-sm" data-bs-toggle="modal"
                            data-bs-target=".addBrandModal">
                            Ajouter une Marque
                        </button>
                    </div>
                </div>

                @include('theme.layouts._parts.__messages')

                <table id="datatable-buttons" class="table table-bordered dt-responsive nowrap w-100">
                    <thead>
                        <tr>
                            <th>Logo</th>
                            <th>Nom</th>
                            <th>Total Produits</th>
                            <th>Action</th>
                        </tr>
                    </thead>

                    <tbody>

                        @foreach ($brands as $brand)
                            <tr>
                                <td>
                                    <div>
                                        @php
                                            $url = $brand->getFirstMediaUrl('brands_logos', 'normal');
                                            
                                        @endphp

                                        <a class="image-popup-no-margins" href="{{ $url }}">
                                            <img class="img-fluid" alt="" src="{{ $url }}"
                                                width="50">
                                        </a>

                                    </div>

                                </td>
                                <td> {{ $brand->name }}</td>

                                <td>
                                    {{ $brand->products_count }}
                                </td>
                                <td>
                                    <div class="d-flex gap-3">

                                        <button class="btn btn-danger btn-sm" type="button"
                                            onclick="
                                                var result = confirm('Are you sure you want to delete this brand ?');

                                                if(result){
                                                    event.preventDefault();
                                                    document.getElementById('delete-brand-{{ $brand->uuid }}').submit();
                                                }">
                                            Supprimer
                                        </button>
                                    </div>
                                </td>
                                <form id="delete-brand-{{ $brand->uuid }}" method="post"
                                    action="{{ route('commercial:brands.delete') }}">
                                    @csrf
                                    @method('DELETE')
                                    <input type="hidden" name="brandId" value="{{ $brand->uuid }}">
                                </form>
                            </tr>
                        @endforeach

                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
