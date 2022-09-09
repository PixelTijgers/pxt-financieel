<?php

// Model Namespacing.
namespace App\Models;

// Facades.
use Illuminate\Database\Eloquent\Model;

// Traits.
use Spatie\Permission\Traits\HasRoles;

// Scopes.
use App\Scopes\AdministratorFixedCostScope;

class FixedCost extends Model
{
    /**
     * Traits
     *
     */
    use HasRoles;

    /**
     * The "booted" method of the model.
     *
     * @return void
     */
    protected static function booted()
    {
        return static::addGlobalScope(new AdministratorFixedCostScope);
    }

    /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */
    protected $fillable = [
        'fiscal_year_id',
        'bankaccount_id',
        'category_id',
        'company_id',
        'is_shared',
        // 'name',
        'cost',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array
     */
    protected $casts = [
        'fiscal_year_id' => 'integer',
        'bankaccount_id' => 'integer',
        'category_id' => 'integer',
        'company_id' => 'integer',
        'cost' => 'float',
        'is_shared' => 'boolean',
    ];

    /**
     * The attributes that should be mutated to dates.
     *
     * @var array
     */
    protected $dates = [
        'created_at',
        'updated_at',
    ];

    /**
     * Model relations.
     *
     */
    public function fiscal_year()
    {
        return $this->belongsTo(\App\Models\FiscalYear::class, 'fiscal_year_id');
    }

    public function category()
    {
        return $this->belongsTo(\App\Models\Category::class);
    }

    public function company()
    {
        return $this->belongsTo(\App\Models\Company::class);
    }

    public function bankaccount()
    {
        return $this->belongsTo(\App\Models\Bankaccount::class);
    }

    public function administrator_fixed_cost()
    {
        return $this->belongsToMany(\App\Models\AdministratorFixedCost::class)->withPivot('admin_id');
    }
}
