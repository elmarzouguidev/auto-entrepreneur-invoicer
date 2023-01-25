<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-body">
                <div class="row">
                    <div class="col-12 mb-4">
                        <button class="btn btn-info" type="button" class="btn btn-info  btn-sm" data-bs-toggle="modal"
                            data-bs-target=".addWarehouseModal">
                            Ajouter un Entrepôt
                        </button>

                    </div>
                </div>

                @include('theme.layouts._parts.__messages')

                <table id="datatable-buttons" class="table table-bordered dt-responsive nowrap w-100">
                    <thead>
                        <tr>

                            <th>Nom</th>
                            <th>Adresse</th>
                            <th>Ville</th>
                            <th>Résponsable</th>
                            <th>Total Produits</th>
                            <th>Action</th>
                        </tr>
                    </thead>

                    <tbody>

                        @foreach ($warehouses as $warehouse)
                            <tr>
                                <td> {{ $warehouse->name }}</td>
                                <td>
                                    {{ $warehouse->address }} DH
                                </td>
                                <td>
                                    {{ $warehouse->city?->name }}
                                </td>
                                <td>
                                    {{ $warehouse->user?->full_name }}
                                </td>
                                <td>
                                    {{ $warehouse->products_count }}
                                </td>
                                <td>
                                    <div class="d-flex gap-3">

                                        <button class="btn btn-danger btn-sm" type="button"
                                            onclick="
                                                var result = confirm('Are you sure you want to delete this warehouse ?');

                                                if(result){
                                                    event.preventDefault();
                                                    document.getElementById('delete-warehouse-{{ $warehouse->uuid }}').submit();
                                                }">
                                            Supprimer
                                        </button>
                                    </div>
                                </td>
                                <form id="delete-warehouse-{{ $warehouse->uuid }}" method="post"
                                    action="{{ route('commercial:warehouses.delete') }}">
                                    @csrf
                                    @method('DELETE')
                                    <input type="hidden" name="warehouseId" value="{{ $warehouse->uuid }}">
                                </form>
                            </tr>
                        @endforeach

                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
