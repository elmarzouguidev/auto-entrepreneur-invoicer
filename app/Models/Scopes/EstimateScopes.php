<?php

namespace App\Models\Scopes;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Carbon;

trait EstimateScopes
{
    public function scopeFiltersStatus($query, $status)
    {
        if ((int) $status == 4) {
            return $query->where('is_send', true);
        } elseif ((int) $status == 3) {
            return $query->where('is_send', false);
        }

        return $query->where('status', $status);
    }

    public function scopeFiltersClients($query, $client)
    {
        return $query->whereClientId($client);
    }

    public function scopeFiltersSend($query, $send)
    {
        //$company = Company::whereUuid($company)->firstOrFail()->id;

        return $query->where('is_send', $send);
    }

    public function scopeFiltersDateEstimate(Builder $query, $from): Builder
    {
        return $query->whereDate('estimate_date', Carbon::createFromFormat('d-m-Y', $from)->format('Y-m-d'));
    }

    public function scopeFiltersCompanies(Builder $query, $company): Builder
    {
        //$company = Company::whereUuid($company)->firstOrFail()->id;

        return $query->where('company_id', $company);
    }

    public function scopeFiltersPeriods(Builder $query, $period): Builder
    {
        //dd($period);
        if ($period == 1) {
            return $query->whereBetween(
                'estimate_date',
                [
                    now()->startOfYear()->startOfQuarter(),
                    now()->startOfYear()->endOfQuarter(),
                ]
            );
        }
        if ($period == 2) {
            return $query->whereBetween(
                'estimate_date',
                [
                    now()->startOfYear()->addMonths(3)->startOfQuarter(),
                    now()->startOfYear()->addMonths(3)->endOfQuarter(),
                ]
            );
        }
        if ($period == 3) {
            return $query->whereBetween(
                'estimate_date',
                [
                    now()->startOfYear()->addMonths(6)->startOfQuarter(),
                    now()->startOfYear()->addMonths(6)->endOfQuarter(),
                ]
            );
        }
        if ($period == 4) {
            return $query->whereBetween(
                'estimate_date',
                [
                    now()->startOfYear()->addMonths(9)->startOfQuarter(),
                    now()->startOfYear()->addMonths(9)->endOfQuarter(),
                ]
            );
        }
    }

    public function scopeFiltersDate(Builder $query, $from, $to): Builder
    {
        return $query->whereBetween(
            'estimate_date',
            [
                Carbon::createFromFormat('Y-m-d', $from)->format('Y-m-d'),
                Carbon::createFromFormat('Y-m-d', $to)->format('Y-m-d'),
            ]
        );
    }

    public function scopeDashboard(Builder $query): Builder
    {
        return $query->select(['id', 'uuid', 'full_number', 'price_ht', 'price_tva', 'price_total', 'is_invoiced', 'due_date', 'estimate_date', 'created_at']);
    }

    public function scopeEstimatesNotsend($query)
    {
        return $query->whereIsSend(false)->count();
    }
}
