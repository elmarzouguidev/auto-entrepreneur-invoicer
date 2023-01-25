<div {{-- data-repeater-list="articles" --}}>

    @foreach ($invoice->articles as $article)
        @livewire('commercial.invoice.edit.edit-article', ['article' => $article, 'invoice' => $invoice], key($loop->index))
    @endforeach

</div>
