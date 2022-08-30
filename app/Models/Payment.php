<?php

// Model Namespacing.
namespace App\Models;

// Facades.
use Illuminate\Database\Eloquent\Model;

// Traits.
use Spatie\Permission\Traits\HasRoles;

// Scopes.
use App\Scopes\AdministratorPaymentScope;

class Payment extends Model
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
        return static::addGlobalScope(new AdministratorPaymentScope);
    }

    /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */
    protected $fillable = [
        'fiscal_year_id',
        'payment_type_id',
        'category_id',
        'company',
        'payment_date',
        'payment_reference'
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array
     */
    protected $casts = [
        'fiscal_year_id' => 'integer',
        'payment_type_id' => 'integer',
        'category_id' => 'integer',
        'payment_date' => 'datetime',
    ];

    /**
     * The attributes that should be mutated to dates.
     *
     * @var array
     */
    protected $dates = [
        'payment_date',
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
    public function payment()
    {
        return $this->belongsTo(\App\Models\Administrator::class, 'payment_type_id');
    }

    public function category()
    {
        return $this->belongsTo(\App\Models\Category::class);
    }

    public function administrator_payments()
    {
        return $this->belongsToMany(\App\Models\AdministratorPayment::class)->withPivot('admin_id');
    }
}
