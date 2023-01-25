<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-body">
                <div class="row">
                    <div class="col-12 mb-4">
                        {{-- <button class="btn btn-info" type="button" class="btn btn-info  btn-sm" data-bs-toggle="modal"
                            data-bs-target=".addProductModal">
                            Ajouter un Produit
                        </button> --}}

                    </div>
                </div>

                
                @include('theme.layouts._parts.__messages')

                <table id="datatable-buttons" class="table table-bordered dt-responsive nowrap w-100">
                    <thead>
                        <tr>

                            <th>trimestre 1</th>
                            <th>trimestre 2</th>
                            <th>trimestre 3</th>
                            <th>trimestre 4</th>
                            <th>Total</th>
                            <th>Action</th>
                        </tr>
                    </thead>

                    <tbody>
                        <h1>Encours ...</h1>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
