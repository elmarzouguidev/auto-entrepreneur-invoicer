<?php

namespace App\Services\Commercial\Remise;

trait RemiseCalculator
{
    public function caluculateRemise($ht_price, $taux)
    {
        return $ht_price - ($ht_price * $taux / 100);
    }

    public function calculateOnlyRemise($ht_price, $taux)
    {
        return $ht_price * $taux / 100;
    }
}
