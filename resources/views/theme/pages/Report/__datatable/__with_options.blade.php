<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-body">

                @include('theme.layouts._parts.__messages')
                
                <div class="table-responsive">
                    <table class="table align-middle table-nowrap mb-0">
                        <thead class="table-light">
                            <tr>
                                <th style="width: 20px;">
                                    <div class="form-check font-size-16 align-middle">
                                        <input class="form-check-input" type="checkbox" id="transactionCheck01">
                                        <label class="form-check-label" for="transactionCheck01"></label>
                                    </div>
                                </th>
                                <th class="align-middle">position</th>
                                <th class="align-middle">client</th>
                                <th class="align-middle">chiffre d'affaire Total</th>
                                <th class="align-middle">chiffre d'affaire encaissé</th>
                                <th class="align-middle">action</th>
                            </tr>
                        </thead>
                        <tbody>

                            @foreach ($clients as $client)
                                <tr>
                                    <td>
                                        <div class="form-check font-size-16">
                                            <input class="form-check-input" type="checkbox"
                                                id="transactionCheck{{ $client->id }}">
                                            <label class="form-check-label"
                                                for="transactionCheck{{ $client->id }}"></label>
                                        </div>
                                    </td>
                                    <td><a href="{{ $client->url }}"
                                            class="text-body fw-bold">{{ $loop->index + 1 }}</a> </td>
                                    <td>{{ $client->entreprise }}</td>
                                    <td>
                                        {{ number_format($client->invoices_sum_price_total, 2) }}
                                    </td>
                                    <td>
                                        {{ number_format($client->price_total_paid, 2) }}
                                    </td>
                                    <td>

                                        <a href="{{ $client->url }}"
                                            class="btn btn-primary btn-sm btn-rounded waves-effect waves-light">
                                            Détails
                                        </a>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
