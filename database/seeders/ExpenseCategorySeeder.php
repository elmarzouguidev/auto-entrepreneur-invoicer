<?php

declare(strict_types=1);

namespace Database\Seeders;

use App\Models\Expense\ExpenseCategory;
use Illuminate\Database\Seeder;

class ExpenseCategorySeeder extends Seeder
{
    /**
     * @return void
     */
    public function run(): void
    {
        $categories = [
            ['name' => 'Agencements & installations'],
            ['name' => 'Amortissement'],
            ['name' => 'Brevets, marques & droits'],
            ['name' => 'Caisses de retraite'],
            ['name' => 'CNSS & AMO'],
            ['name' => 'Communication'],
            ['name' => 'Comptabilité'],
            ['name' => 'Cotisations et dons'],
            ['name' => 'Cotisations patronales'],
            ['name' => 'Déplacements, missions & réceptions'],
            ['name' => 'Eau & Électricité'],
            ['name' => 'Fond commercial'],
            ['name' => 'Frais bancaires'],
            ['name' => 'Frais de constitution'],
            ['name' => 'Impôts sur les résultats'],
            ['name' => 'Installations techniques'],
            ['name' => 'Marchandises'],
            ['name' => 'Matériel de bureau'],
            ['name' => 'Matériel informatique'],
            ['name' => 'Matières consommables'],
            ['name' => 'Matières premières'],
            ['name' => 'Mobilier de bureau'],
            ['name' => 'Mutuelles'],
            ['name' => 'Paiement de TVA'],
            ['name' => 'Prêts au personnel'],
            ['name' => 'Prêts aux associés'],
            ['name' => "Produits d'entretien"],
            ['name' => 'Publicité'],
            ['name' => 'Restauration'],
            ['name' => 'Retrait'],
            ['name' => 'Salaires'],
            ['name' => 'Téléphone & Internet'],
            ['name' => 'Transport du personnel'],

        ];

        foreach ($categories as $category) {
            ExpenseCategory::create($category);
        }
    }
}
