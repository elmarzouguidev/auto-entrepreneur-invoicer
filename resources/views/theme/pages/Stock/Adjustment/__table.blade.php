<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-body">
                <div class="row">
                    <div class="col-12 mb-4">
                        <button class="btn btn-info" type="button" class="btn btn-info  btn-sm" data-bs-toggle="modal"
                            data-bs-target=".addAdjustmentModal">
                            Créer un ajustement
                        </button>

                    </div>
                </div>

                @include('theme.layouts._parts.__messages')

                <table id="datatable-buttons" class="table table-bordered dt-responsive nowrap w-100">
                    <thead>
                        <tr>

                            <th>Date</th>
                            <th>Référence</th>
                            <th>ENTREPÔT</th>
                            <th>Total Produits</th>
                            <th>Utilisateur</th>
                            <th>Action</th>

                        </tr>
                    </thead>

                    <tbody>

                        @foreach ($adjustments as $adjustment)
                            <tr>
                                <td> {{ $adjustment->created_at->format('d-m-Y') }}</td>
                                <td>
                                    {{ $adjustment->reference }} DH
                                </td>
                                <td>
                                    {{ $adjustment->warehouse?->name }}
                                </td>
                                <td>
                                    {{ $adjustment->adjustments_products_count }}
                                </td>
                                <td>
                                    {{ $adjustment->user?->full_name }}
                                </td>
                                <td>
                                    <div class="d-flex gap-3">
                                        <button class="btn btn-success btn-sm" type="button" data-bs-toggle="modal"
                                            data-bs-target=".showAdjustmentDetails{{ $adjustment->uuid }}">
                                            Editer
                                        </button>
                                        <button class="btn btn-info btn-sm" type="button" data-bs-toggle="modal"
                                            data-bs-target=".showAdjustmentDetails{{ $adjustment->uuid }}">
                                            Détails
                                        </button>
                                        <button class="btn btn-primary btn-sm" type="button" data-bs-toggle="modal"
                                            data-bs-target=".showAdjustmentHistory{{ $adjustment->uuid }}">
                                            Historiques
                                        </button>
                                        <button class="btn btn-danger btn-sm" type="button"
                                            onclick="
                                                var result = confirm('Are you sure you want to delete this adjustment ?');

                                                if(result){
                                                    event.preventDefault();
                                                    document.getElementById('delete-adjustment-{{ $adjustment->uuid }}').submit();
                                                }">
                                            Supprimer
                                        </button>
                                    </div>
                                </td>
                                <form id="delete-adjustment-{{ $adjustment->uuid }}" method="post"
                                    action="{{ route('commercial:adjustments.delete') }}">
                                    @csrf
                                    @method('DELETE')
                                    <input type="hidden" name="adjustmentId" value="{{ $adjustment->uuid }}">
                                </form>
                            </tr>
                        @endforeach

                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
