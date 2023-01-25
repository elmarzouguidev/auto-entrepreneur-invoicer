<div class="modal fade importClientModal" tabindex="-1" role="dialog" aria-labelledby=orderdetailsModalLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id=orderdetailsModalLabel">Importer la list des clients</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form method="post" action="{{ route('admin:clients.import') }}" enctype="multipart/form-data">
                    @csrf

                    <div class="row mb-3">
                        <label class="col-form-label col-lg-2">List *</label>
                        <div class="col-lg-10">
                            <input class="form-control @error('file') is-invalid @enderror" name="file" type="file"
                             accept=".xlsx, .xls, .csv"
                             required />
                            @error('file')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                    </div>
                    <div class="row justify-content-end">
                        <div class="col-lg-10">
                            <button type="submit" class="btn btn-primary">Importer</button>
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>
