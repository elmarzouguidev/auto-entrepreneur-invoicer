<?php

namespace App\Models\Scopes;

use App\Constants\Etat;

trait TicketScopes
{
    public function scopeFiltersStatus($query, $status)
    {
        return $query
            ->whereIn('etat', [Etat::NON_REPARABLE, Etat::REPARABLE, Etat::NON_DIAGNOSTIQUER])
            ->where('status', $status);
    }

    public function scopeFiltersClient($query, $client)
    {
        return $query
            ->whereIn('etat', [Etat::NON_REPARABLE, Etat::REPARABLE, Etat::NON_DIAGNOSTIQUER])
            ->whereClientId($client);
    }

    public function scopeFiltersRetour($query, $retour)
    {
        return $query->where('is_retour', true);
    }

    public function scopeFiltersEtat($query, $etat)
    {
        return $query
            ->where('etat', $etat);
    }
}
