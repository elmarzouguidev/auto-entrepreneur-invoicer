@if ($adjustment->adjustments_products_count)
    <div class="modal fade showAdjustmentDetails{{$adjustment->uuid}}" tabindex="-1" role="dialog"
         aria-labelledby=orderdetailsModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-xl modal-dialog-scrollable" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id=orderdetailsModalLabel">Ajustement REF : {{ $adjustment->reference }}</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <table id="datatable-buttons" class="table table-bordered dt-responsive nowrap w-100">
                        <thead>
                            <tr>
    
                                <th>Date</th>
                                <th>Produit</th>
                                <th>Quantité</th>
                                <th>Type</th>
        
                            </tr>
                        </thead>
    
                        <tbody>
    
                            @foreach ($adjustment->adjustmentsProducts as $adjustment)
                                <tr>
                                    <td> {{ $adjustment->created_at->format('d-m-Y') }}</td>
                                    <td>
                                        {{ $adjustment->product?->name }}
                                    </td>
                                    <td>
                                        {{ $adjustment->qte }}
                                    </td>
                                    <td>
                                        {{ $adjustment->get_type }}
                                    </td>
                                </tr>
                            @endforeach
    
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endif