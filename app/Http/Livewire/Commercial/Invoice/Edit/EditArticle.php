<?php

namespace App\Http\Livewire\Commercial\Invoice\Edit;

use App\Http\Requests\Commercial\Invoice\ArticleUpdateFormRequest;
use App\Models\Finance\Article;
use App\Models\Finance\Invoice;
use App\Services\Commercial\Remise\RemiseCalculator;
use Livewire\Component;

class EditArticle extends Component
{

    use RemiseCalculator;

    public Article $article;

    public Invoice $invoice;

    public $designation;

    public $description;

    public $quantity;

    public $prix_unitaire;

    public $remise;

    public $montant_ht;

    public function render()
    {
        return view('theme.livewire.commercial.invoice.edit.edit-article');
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
        $invoice = $this->invoice;

        $article = $this->article;

        $oldArticlePrice = $article->montant_ht;

        if ($article && $invoice) {
            $itemPrice = $this->prix_unitaire * $this->quantity;
            $finalePrice = $this->caluculateRemise($itemPrice, $this->remise ?? 0);
            $tauxRemise = $this->calculateOnlyRemise($itemPrice, $this->remise ?? 0);

            $article->update([
                'designation' => $this->designation,
                'description' => $this->description,
                'quantity' => $this->quantity,
                'prix_unitaire' => $this->prix_unitaire,
                'montant_ht' => $finalePrice,
                'remise' => $this->remise ?? 0,
                'taux_remise' => $tauxRemise ?? 0,
            ]);
        }

        $totalPrice = ($invoice->price_total - $oldArticlePrice) + $article->montant_ht;
        $invoice->price_total = $totalPrice;
        $invoice->save();

        $invoice->histories()->create([
            'user_id' => auth()->id(),
            'user' => auth()->user()->full_name,
            'detail' => 'a modifier un article depuis le DEVIS ',
            'action' => 'update',
        ]);

        return redirect($invoice->edit_url)->with('success', "L'article a été modifier avec success");
    }
}
