<div class="col-xl-9 col-lg-8">
    <div class="card">

        <ul class="nav nav-tabs nav-tabs-custom justify-content-center pt-2" role="tablist">
            <li class="nav-item">
                <a class="nav-link active" data-bs-toggle="tab" href="#all-settings" role="tab">
                    Page
                </a>
            </li>
        </ul>

        <div class="tab-content p-4">
            <div class="tab-pane active" id="all-settings" role="tabpanel">
                <div>
                    <div class="row justify-content-center">
                        <div class="col-xl-12">
                            <div>
                                <div class="row align-items-center">
                                    <div class="col-4">
                                        <div>
                                            <h5 class="mb-0"></h5>
                                        </div>
                                    </div>
                                </div>
                                <!-- end row -->

                                <div>
                                    <div class="col-12">

        
                                        @include('layouts._parts.__messages')
    
                                        <form method="POST" action="{{ route('admin:settings.page.store') }}">
                                            <div class="mb-3 row">

                                                <label for="invoice_prefix" class="col-md-2 col-form-label">
                                                    condition general d'ajout de produit
                                                </label>

                                                <div class="col-md-10">
                                         
                                                    <textarea rows="10" class="form-control" name="product_condition" required>{{ $setting->product_condition }}
                                                        
                                                    </textarea>   

                                                </div>
                                            </div>
                                            @csrf
                         
                                            <div class="d-flex flex-wrap gap-2">
                                                <button type="submit"
                                                    class="btn btn-primary waves-effect waves-light">update</button>
                                            </div>
                                        </form>

                                    </div>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
