<?php

namespace App\Http\Livewire\Commercial\BonCommand\Edit;

use App\Http\Requests\Commercial\BCommand\ArticleUpdateFormRequest;
use App\Models\Finance\Article;
use App\Models\Finance\BCommand;
use App\Services\Commercial\Remise\RemiseCalculator;
use App\Services\Commercial\Taxes\TVACalulator;
use Livewire\Component;

class EditArticle extends Component
{
    use TVACalulator;
    use RemiseCalculator;

    public Article $article;

    public BCommand $command;

    public $designation;

    public $description;

    public $quantity;

    public $prix_unitaire;

    public $remise;

    public $montant_ht;

    public function render()
    {
        return view('theme.livewire.commercial.bon-command.edit.edit-article');
    }

    public function mount()
    {
        $this->designation = str_replace('<br />', '', $this->article->designation);
        $this->description = str_replace('<br />', '', $this->article->description);
        $this->quantity = $this->article->quantity;
        $this->prix_unitaire = $this->article->prix_unitaire;
        $this->remise = $this->article->remise;
        $this->montant_ht = $this->article->montant_ht;
    }

    public function rules()
    {
        return (new ArticleUpdateFormRequest())->rules();
    }

    public function updateArticle()
    {
        $command = $this->command;

        $article = $this->article;

        $oldArticlePrice = $article->montant_ht;

        if ($article && $command) {
            $finalePrice = $this->prix_unitaire * $this->quantity;

            $article->update([
                'designation' => $this->designation,
                'description' => $this->description,
                'quantity' => $this->quantity,
                'prix_unitaire' => $this->prix_unitaire,
                'montant_ht' => $finalePrice,
                'remise' => 0,
                'taux_remise' => 0,
            ]);
        }

        $totalPrice = ($command->price_ht - $oldArticlePrice) + $article->montant_ht;
        $command->price_ht = $totalPrice;
        $command->price_total = $this->caluculateTva($totalPrice);
        $command->price_tva = $this->calculateOnlyTva($totalPrice);

        $command->save();

        $command->histories()->create([
            'user_id' => auth()->id(),
            'user' => auth()->user()->full_name,
            'detail' => 'a modifier un article depuis le BC ',
            'action' => 'update',
        ]);

        return redirect($command->edit_url)->with('success', "L'article a été modifier avec success");
    }
}
