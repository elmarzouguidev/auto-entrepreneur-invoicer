<div {{-- data-repeater-list="articles" --}}>

    @foreach ($command->articles as $article)
        @livewire('commercial.bon-command.edit.edit-article', ['article' => $article, 'command' => $command], key($loop->index))
    @endforeach

</div>
