<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('administrator_fixed_cost', function (Blueprint $table) {
            // Set up pivot table.
            $table->bigInteger('admin_id')->unsigned()->index();
            $table->foreign('admin_id')->references('id')->on('administrators')->onDelete('cascade');
            $table->bigInteger('fixed_cost_id')->unsigned()->index();
            $table->foreign('fixed_cost_id')->references('id')->on('fixed_costs')->onDelete('cascade');
            $table->primary(['admin_id', 'fixed_cost_id']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('administrator_fixed_cost');
    }
};
