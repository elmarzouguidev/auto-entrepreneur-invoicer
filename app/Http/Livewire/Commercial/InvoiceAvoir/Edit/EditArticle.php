<?php

namespace App\Http\Livewire\Commercial\InvoiceAvoir\Edit;

use App\Http\Requests\Commercial\InvoiceAvoir\ArticleUpdateFormRequest;
use App\Models\Finance\Article;
use App\Models\Finance\InvoiceAvoir;
use App\Services\Commercial\Remise\RemiseCalculator;
use App\Services\Commercial\Taxes\TVACalulator;
use Livewire\Component;

class EditArticle extends Component
{
    use TVACalulator;
    use RemiseCalculator;

    public Article $article;

    public InvoiceAvoir $invoice;

    public $designation;

    public $description;

    public $quantity;

    public $prix_unitaire;

    public $montant_ht;

    public function render()
    {
        return view('theme.livewire.commercial.invoice-avoir.edit.edit-article');
    }

    public function mount()
    {
        $this->designation = str_replace('<br />', '', $this->article->designation);
        $this->description = str_replace('<br />', '', $this->article->description);
        $this->quantity = $this->article->quantity;
        $this->prix_unitaire = $this->article->prix_unitaire;
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

        $totalPrice = ($invoice->price_ht - $oldArticlePrice) + $article->montant_ht;
        $invoice->price_ht = $totalPrice;
        $invoice->price_total = $this->caluculateTva($totalPrice);
        $invoice->price_tva = $this->calculateOnlyTva($totalPrice);

        $invoice->save();

        $invoice->histories()->create([
            'user_id' => auth()->id(),
            'user' => auth()->user()->full_name,
            'detail' => 'a modifier un article depuis lA FACTURE ',
            'action' => 'update',
        ]);

        return redirect($invoice->edit_url)->with('success', "L'article a été modifier avec success");
    }
}
