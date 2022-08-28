<?php

// Namespacing.
namespace App\Scopes;

// Facades.
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Scope;

// Models.
use App\Models\AdministratorBankaccount;

class AdministratorsBankaccountScope implements Scope
{
    /**
     * Apply the scope to a given Eloquent query builder.
     *
     * @param  \Illuminate\Database\Eloquent\Builder  $builder
     * @param  \Illuminate\Database\Eloquent\Model  $model
     * @return void
     */
    public function apply(Builder $builder, Model $model)
    {
        $builder->join('administrator_bankaccount', 'bankaccounts.id', '=', 'administrator_bankaccount.bankaccount_id')
                ->where('admin_id', auth()->user()->id);
    }
}
