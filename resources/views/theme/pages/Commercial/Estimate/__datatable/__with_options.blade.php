<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-body">
                <div class="row">
                    <div class="col-12 mb-4">
                        <a href="{{ route('commercial:estimates.create') }}" type="button" class="btn btn-info">
                            Créer un devis
                        </a>

                        {{--<a class="popup-form btn btn-primary" href="#addEstimateModal">nouveau devis</a>--}}
                    </div>
                </div>

                @include('theme.layouts._parts.__messages')

                <table id="datatable-buttons" class="table table-bordered dt-responsive nowrap w-100">
                    <thead>
                        <tr>
                            {{-- <th style="width: 20px;" class="align-middle">
                            <div class="form-check font-size-16">
                                <input class="form-check-input" type="checkbox" id="checkAll">
                                <label class="form-check-label" for="checkAll"></label>
                            </div>
                        </th> --}}
                            <th>{{ __('estimate.table.number') }}</th>
                            <th>{{ __('estimate.table.client') }}</th>
                            <th>{{ __('estimate.table.date_estimate') }}</th>
                            <th>{{ __('estimate.table.total_ht') }}</th>
                            <th>{{ __('estimate.table.total_tva') }}</th>
                            <th>{{ __('estimate.table.total_total') }}</th>
                            <th>{{ __('estimate.table.date_due') }}</th>
                            <th>Facture</th>
                            <th>Envoyer</th>
                            <th>Action</th>
                        </tr>
                    </thead>

                    <tbody>

                        @foreach ($estimates as $estimate)
                            <tr>
                                {{-- <td>
                                <div class="form-check font-size-16">
                                    <input class="form-check-input" type="checkbox"
                                        id="orderidcheck-{{ $estimate->id }}">
                                    <label class="form-check-label"
                                        for="orderidcheck-{{ $estimate->id }}"></label>
                                </div>
                            </td> --}}
                                <td>
                                    <a href="#" class="text-body fw-bold">
                                        {{ $estimate->code }}
                                    </a>

                                </td>
                                <td> {{ optional($estimate->client)->entreprise }}</td>
                                <td>
                                    {{ $estimate->estimate_date->format('d-m-Y') }}
                                </td>
                                <td>
                                    {{ $estimate->formated_price_ht }} DH
                                </td>
                                <td>
                                    {{ $estimate->formated_total_tva }} DH
                                </td>
                                <td>
                                    {{ $estimate->formated_price_total }} DH
                                </td>
                                <td>
                                    {{ $estimate->due_date->format('d-m-Y') }}
                                </td>
                                <td>
                                    @if (!$estimate->is_invoiced)
                                        <a href="{{ $estimate->create_invoice_url }}" type="button"
                                            class="btn btn-primary btn-sm btn-rounded">
                                            Créer une facture
                                        </a>
                                    @else
                                        @if ($estimate->invoice_count)
                                            <a href="#" class="btn btn-info btn-sm">
                                                Déjà facturé
                                            </a>
                                        @endif
                                    @endif
                                </td>
                                <td>
                                    @if (!$estimate->is_send)
                                        <button type="button" class="btn btn-warning  btn-sm" data-bs-toggle="modal"
                                            data-bs-target=".sendEstimate-{{ $estimate->uuid }}">
                                            Envoyer
                                        </button>
                                    @else
                                        <a href="#{{-- $estimate->invoice_url --}}" type="button" class="btn btn-info btn-sm">
                                            Déjà Envoyé
                                        </a>
                                    @endif
                                </td>
                                <td>
                                    <div class="d-flex gap-3">

                                        <a href="#" target="__blank" class="text-success" data-bs-toggle="modal"
                                            data-bs-target=".printEstimate-{{ $estimate->uuid }}">
                                            <i class="mdi mdi-file-pdf-outline font-size-18"></i>
                                        </a>

                                        <a href="{{ $estimate->edit_url }}" class="text-success">
                                            <i class="mdi mdi-pencil font-size-18"></i>
                                        </a>
                                    </div>
                                </td>

                            </tr>
                        @endforeach

                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>