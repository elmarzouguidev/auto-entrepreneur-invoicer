<div>

    <div class="row">
        <input type="hidden" name="articleuuid" value="{{ $article->uuid }}">
        <div class="mb-3 col-lg-3">
            <label for="designation">Désignation</label>
            <textarea wire:model="designation" name="designation" id="designation" rows="5"
                class="form-control @error('articles.*.designation') is-invalid @enderror">{{ str_replace('<br />', '', $article->designation) }}</textarea>

            @error('articles.*.designation')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>
        <div class="mb-3 col-lg-3">
            <label for="description">Description</label>
            <textarea wire:model="description" name="description" id="description" rows="5"
                class="form-control @error('articles.*.description') is-invalid @enderror">{{ str_replace('<br />', '', $article->description) }}</textarea>

            @error('articles.*.description')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>

        <div class="mb-3 col-lg-1">
            <label for="quantity">Qté.</label>
            <input type="text" wire:model="quantity" name="quantity" id="quantity" value="{{ $article->quantity }}"
                min="1" class="form-control @error('articles.*.quantity') is-invalid @enderror" />
            @error('quantity')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>

        <div class="mb-3 col-lg-1">
            <label for="prix_unitaire">Prix UT</label>
            <input type="text" wire:model="prix_unitaire" name="prix_unitaire" id="prix_unitaire"
                value="{{ $article->prix_unitaire }}"
                class="form-control @error('articles.*.prix_unitaire') is-invalid @enderror" />

            @error('prix_unitaire')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>
        
        <div class="mb-3 col-lg-2">
            <label for="montant_ht">Montant HT</label>
            <input type="text" name="montant_ht" id="montant_ht" value="{{ $article->formated_montant_ht }}"
                class="form-control @error('articles.*.montant_ht') is-invalid @enderror" readonly />
            @error('montant_ht')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>
        <div class="mb-3 col-lg-1">

            <button title="editer l'article" wire:click="updateArticle()" type="button"
                class="mt-4 btn btn-info waves-effect waves-light">

                <i class="fas fa-edit font-size-16"></i>
            </button>

        </div>
        <div class="mb-3 col-lg-1">

            <button type="button" class="deleteRecordAvoir mt-4 btn btn-danger waves-effect waves-light"
                data-article="{{ $article->uuid }}" data-invoice="{{ $invoice->uuid }}">
                <i class="fas fa-trash-alt font-size-16"></i>
            </button>

        </div>
    </div>

</div>
