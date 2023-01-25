<div class="card mfp-hide mfp-popup-form mx-auto" id="addEstimateModal">
    <div class="card-body">
        <h4 class="mb-4">Form</h4>
        <form>
            <div class="row">
                <div class="col-lg-4">
                    <div class="mb-3">
                        <label for="name" class="form-label">Name</label>
                        <input type="text" class="form-control" id="name" placeholder="Enter Name">
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="input-group" id="datepicker1">
                        <input type="text" name="estimate_date" id="filterDate"
                            class="form-control @error('estimate_date') is-invalid @enderror"
                            value="{{ request()->input('appFilter.GetEstimateDate') }}" data-date-format="yyyy-mm-dd"
                            data-date-container='#datepicker1' data-provide="datepicker" placeholder="Date">

                        <span class="input-group-text"><i class="mdi mdi-calendar"></i></span>
                        @error('estimate_date')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </div>

            </div>


            <div class="text-end">
                <button type="submit" class="btn btn-primary">Submit</button>
            </div>
        </form>
    </div>
</div>
