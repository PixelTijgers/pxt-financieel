<?php

// Namespace
namespace App\Models;

// Facades
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AdministratorBankaccount extends Model
{
    /**
    * Traits
    *
    */
    use HasFactory;

    /**
    * Table variables
    *
    */
    public $timestamps = false;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'administrator_bankaccount';
}
