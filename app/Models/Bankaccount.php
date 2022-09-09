<?php

// Model Namespacing.
namespace App\Models;

// Facades.
use Illuminate\Database\Eloquent\Model;

// Traits.
use Spatie\Permission\Traits\HasRoles;

// Scopes.
use App\Scopes\AdministratorsBankaccountScope;

class Bankaccount extends Model
{
    /**
     * Traits
     *
     */
    use HasRoles;

    /**
     * The attributes that should be hidden for arrays.
     */
     protected $hidden = ['id'];

    /**
     * The "booted" method of the model.
     *
     * @return void
     */
    protected static function booted()
    {
        return static::addGlobalScope(new AdministratorsBankaccountScope);
    }

    /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */
    protected $fillable = [
        'bankaccount_type_id',
        'name',
        'accountnumber',
        'balance',
        'is_shared',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array
     */
    protected $casts = [
        'bankaccount_types_id' => 'integer',
        'balance' => 'float',
        'is_shared' => 'boolean'
    ];

    /**
     * Model relations.
     *
     */
    public function bankaccount_types()
    {
        return $this->belongsTo(\App\Models\BankaccountType::class, 'bankaccount_type_id');
    }

    public function administrator_bankaccounts()
    {
        return $this->belongsToMany(\App\Models\AdministratorBankaccount::class)->withPivot('admin_id');
    }
}
