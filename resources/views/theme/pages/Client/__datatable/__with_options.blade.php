<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-body">
                <div class="row">
                    <div class="col-lg-8">

                        <div class="col-lg-12 mb-4">
                            <a href="{{ route('admin:clients.create') }}" type="button" class="btn btn-info">
                                {{ __('navbar.clients_add') }}
                            </a>
                            <button class="btn btn-primary" type="button" data-bs-toggle="modal"
                                data-bs-target=".importClientModal">
                                Importer la list des clients
                            </button>
                        </div>
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
                            <th scope="col">Code Client</th>
                            <th scope="col">Entreprise</th>
                            <th scope="col">Telephone</th>
                            <th scope="col">Email</th>
                            <th scope="col">ICE</th>
                            <th scope="col">RC</th>
                            @if (auth()->user()->hasAnyRole('Admin', 'SuperAdmin'))
                                <th scope="col">Action</th>
                            @endif
                        </tr>
                    </thead>

                    <tbody>

                        @foreach ($clients as $client)
                            <tr>
                                {{-- <td>
                                <div class="form-check font-size-16">
                                    <input class="form-check-input" type="checkbox"
                                        id="client-{{ $client->id }}">
                                    <label class="form-check-label" for="client-{{ $client->id }}"></label>
                                </div>
                            </td> --}}
                                <td>
                                    <a href="{{ $client->url }}" class="text-body fw-bold">
                                        {{ $client->code }}
                                    </a>
                                </td>
                                <td>
                                    {{ $client->entreprise }}
                                    <p class="text-muted mb-0">{{ $client->contact }}</p>
                                </td>
                                <td>
                                    {{ $client->telephone }}
                                </td>
                                <td>
                                    {{ $client->email }}
                                </td>
                                <td>
                                    {{ $client->ice }}
                                </td>
                                <td>
                                    {{ $client->rc }}
                                </td>

                                @if (auth()->user()->hasAnyRole('Admin', 'SuperAdmin'))
                                    <td>
                                        <div class="d-flex gap-3">

                                            <a href="{{ $client->edit }}" class="text-success">
                                                <i class="mdi mdi-pencil font-size-18"></i>
                                            </a>
                                            <a href="#" class="text-danger"
                                                onclick="
                                            var result = confirm('Are you sure you want to delete this client ?');

                                            if(result){
                                            event.preventDefault();
                                            document.getElementById('delete-client-{{ $client->uuid }}').submit();
                                            }">
                                                <i class="mdi mdi-delete font-size-18"></i>
                                            </a>
                                        </div>
                                    </td>
                                    <form id="delete-client-{{ $client->uuid }}" method="post"
                                        action="{{ route('admin:clients.delete') }}">
                                        @csrf
                                        @method('DELETE')
                                        <input type="hidden" name="clientId" value="{{ $client->uuid }}">
                                    </form>
                                @endif
                            </tr>
                        @endforeach

                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
