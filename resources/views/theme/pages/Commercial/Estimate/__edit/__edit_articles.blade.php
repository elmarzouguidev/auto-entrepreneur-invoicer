<div {{-- data-repeater-list="articles" --}}>

    @foreach ($estimate->articles as $article)
        @livewire('commercial.estimate.edit.edit-article', ['article' => $article, 'estimate' => $estimate], key($loop->index))
    @endforeach

</div>
