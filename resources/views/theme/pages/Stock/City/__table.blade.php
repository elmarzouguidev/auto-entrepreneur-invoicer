<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-body">
                <div class="row">
                    <div class="col-12 mb-4">
                        <button class="btn btn-success" type="button" class="btn btn-info  btn-sm" data-bs-toggle="modal"
                            data-bs-target=".addCityModal">
                            Ajouter une Ville
                        </button>
                    </div>
                </div>

                @include('theme.layouts._parts.__messages')

                <table id="datatable-buttons" class="table table-bordered dt-responsive nowrap w-100">
                    <thead>
                        <tr>

                            <th>Nom</th>
                            <th>Total Entrepôts</th>

                            <th>Action</th>
                        </tr>
                    </thead>

                    <tbody>

                        @foreach ($cities as $city)
                            <tr>

                                <td> {{ $city->name }}</td>

                                <td>
                                    {{ $city->warehouses_count }}
                                </td>
                                <td>
                                    <div class="d-flex gap-3">

                                        <button class="btn btn-danger btn-sm" type="button"
                                            onclick="
                                                var result = confirm('Are you sure you want to delete this city ?');

                                                if(result){
                                                    event.preventDefault();
                                                    document.getElementById('delete-city-{{ $city->uuid }}').submit();
                                                }">
                                            Supprimer
                                        </button>
                                    </div>
                                </td>
                                <form id="delete-city-{{ $city->uuid }}" method="post"
                                    action="{{ route('commercial:cities.delete') }}">
                                    @csrf
                                    @method('DELETE')
                                    <input type="hidden" name="cityId" value="{{ $city->uuid }}">
                                </form>
                            </tr>
                        @endforeach

                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
