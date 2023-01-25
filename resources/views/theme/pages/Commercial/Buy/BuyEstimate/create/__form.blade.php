<div class="row">
    <div class="col-lg-12">
        <form class="repeater" action="{{ route('buy:invoices.store') }}" method="post">
            @csrf
            <div class="card">
                <div class="card-body">
                    @include('theme.pages.Commercial.Buy.BuyInvoice.create.__invoice_info')
                </div>
            </div>

            <div class="card">
                <div class="card-body">
                    <p class="card-title-desc">{{ __('invoice.form.title') }}</p>
                    <div class="row">
                        <div class="col-lg-4">

                        </div>
                        <div class="col-lg-4">

                        </div>

                    </div>
                    <div class="row">
                        <div class="col-lg-12 mb-4">
                            @include('theme.pages.Commercial.Buy.BuyInvoice.create.__form_articles')
                        </div>
                    </div>
                    {{-- @livewire('commercial.invoice.create.articles') --}}

                </div>
            </div>
            <div class="d-flex flex-wrap gap-2 justify-content-end mb-4">
                <div class="">
                    <button type="submit" class="btn btn-primary waves-effect waves-light" {{-- onclick='document.getElementById("overlayy").style.display = "block"' --}}>
                        {{ __('buttons.store') }}

                    </button>

                </div>
            </div>

        </form>
    </div>
</div>
