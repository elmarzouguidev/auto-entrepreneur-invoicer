<div class="row">
    <div class="col-xl-4">
        <div class="card overflow-hidden">
            <div class="bg-primary bg-soft">
                <div class="row">
                    <div class="col-7">
                        <div class="text-primary p-3">
                            <h5 class="text-primary">Profil du Client</h5>

                        </div>
                    </div>
                    <div class="col-5 align-self-end">
                        <img src="{{ asset('assets/images/profile-img.png') }}" alt="" class="img-fluid">
                    </div>
                </div>
            </div>
            <div class="card-body pt-0">
                <div class="row">
                    <div class="col-sm-4">
                        <div class="avatar-md profile-user-wid mb-4">
                            <img src="{{ $client->getFirstMediaUrl('clients-logo', 'thumb') }}" alt=""
                                class="img-thumbnail rounded-circle">
                        </div>
                        <h5 class="font-size-15 text-truncate">{{ $client->entreprise }}</h5>
                        <p class="text-muted mb-0 text-truncate">{{ $client->contact }}</p>
                    </div>

                    <div class="col-sm-8">
                        <div class="pt-4">

                            <div class="row">
                                <div class="col-6">
                                    <h5 class="font-size-15">00 </h5>
                                    <p class="text-muted mb-0">Factures</p>
                                </div>
                                {{-- <div class="col-6">
                                    <h5 class="font-size-15">$1245</h5>
                                    <p class="text-muted mb-0">Revenue</p>
                                </div> --}}
                            </div>
                            {{-- <div class="mt-4">
                                <a href="javascript: void(0);" class="btn btn-primary waves-effect waves-light btn-sm">View Profile <i class="mdi mdi-arrow-right ms-1"></i></a>
                            </div> --}}
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- end card -->

        <div class="card">
            <div class="card-body">
                <h4 class="card-title mb-4">information personnelle</h4>

                <p class="text-muted mb-4">
                    {{ $client->description }}
                </p>
                <div class="table-responsive">
                    <table class="table table-nowrap mb-0">
                        <tbody>
                            <tr>
                                <th scope="row">Nom Complet :</th>
                                <td>{{ $client->contact }}</td>
                            </tr>
                            <tr>
                                <th scope="row">Tél :</th>
                                <td>{{ $client->telephone }}</td>
                            </tr>
                            <tr>
                                <th scope="row">E-mail :</th>
                                <td>{{ $client->email }}</td>
                            </tr>
                            <tr>
                                <th scope="row">Adresse :</th>
                                <td>{{ $client->addresse }}</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

    </div>

    <div class="col-xl-8">

        <div class="row">

            <div class="col-md-6">
                <div class="card mini-stats-wid">
                    <div class="card-body">
                        <div class="d-flex">
                            <div class="flex-grow-1">
                                <p class="text-muted fw-medium mb-2">Total Chiffre d'affaire</p>
                                <h4 class="mb-0">{{ number_format($client->invoices_sum_price_total, 2) }}</h4>
                            </div>

                            <div class="flex-shrink-0 align-self-center">
                                <div class="avatar-sm mini-stat-icon rounded-circle bg-primary">
                                    <span class="avatar-title">
                                        <i class="bx bx-package font-size-24"></i>
                                    </span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="card mini-stats-wid">
                    <div class="card-body">
                        <div class="d-flex">
                            <div class="flex-grow-1">
                                <p class="text-muted fw-medium mb-2"> Total chiffre d'affaire encaissé</p>
                                <h4 class="mb-0">{{ number_format($client->price_total_paid, 2) }}</h4>
                            </div>

                            <div class="flex-shrink-0 align-self-center">
                                <div class="avatar-sm mini-stat-icon rounded-circle bg-primary">
                                    <span class="avatar-title">
                                        <i class="bx bx-hourglass font-size-24"></i>
                                    </span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        @if ($client->invoices_sum_price_total)
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title mb-4">{{ $chart->options['chart_title'] }}</h4>

                    {!! $chart->renderHtml() !!}

                </div>
            </div>
        @endif

    </div>
</div>
<!-- end row -->
