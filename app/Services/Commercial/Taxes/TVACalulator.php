<?php

namespace App\Services\Commercial\Taxes;

trait TVACalulator
{
    public function caluculateTva($ht_price)
    {
        return $ht_price * 1.2;
        //return round((20 / 100) * $ht_price);
    }

    public function calculateOnlyTva($ht_price)
    {
        return round($ht_price * 0.2);
    }

    public function caluculateTotalWithTax($ht_price, $taxRate)
    {
        $taxRate = str_replace('%', '', $taxRate);

        $tax = $ht_price * $taxRate / 100;

        $total = $ht_price + $tax;

        //$calculatedTaxRate = (($total - $ht_price) / $ht_price) * 100;

        return $total;
    }

    public function calculateOnlyTax($ht_price, $taxRate)
    {
        $taxRate = str_replace('%', '', $taxRate);

        $tax = $ht_price * $taxRate / 100;

        $total = $ht_price + $tax;

        $calculatedTaxRate = (($total - $ht_price) / $ht_price) * 100;

        $finalTaxe = ($calculatedTaxRate * 100) / 10;
        //dd($taxRate,$tax,$total,round($finalTaxe));
        //return round($finalTaxe);
        //return round($tax);
        return $tax;
    }
}
