<?php

// Model Namespacing.
namespace App\Models;

// Facades.
use Illuminate\Database\Eloquent\Model;

// Traits.
use Spatie\Permission\Traits\HasRoles;

class Game extends Model
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
        //return static::addGlobalScope(new SeasonScope);
    }

    /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */
    protected $fillable = [
        'team_one_id',
        'team_two_id',
        'field',
        'game_date'
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array
     */
    protected $casts = [
        'team_one_id' => 'integer',
        'team_two_id' => 'integer',
        'field' => 'integer',
    ];

    /**
     * The attributes that should be mutated to dates.
     *
     * @var array
     */
    protected $dates = [
        'game_date',
        'created_at',
        'updated_at',
    ];

    /**
     * Model relations.
     *
     */
    public function teamOne()
    {
        return $this->belongsTo(\App\Models\Team::class, 'team_one_id');
    }

    public function teamTwo()
    {
        return $this->belongsTo(\App\Models\Team::class, 'team_two_id');
    }
}
