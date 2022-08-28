<?php

// Facades.
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('administrator_bankaccount', function (Blueprint $table) {

            // Set up pivot table.
            $table->bigInteger('admin_id')->unsigned()->index();
            $table->foreign('admin_id')->references('id')->on('administrators')->onDelete('cascade');
            $table->bigInteger('bankaccount_id')->unsigned()->index();
            $table->foreign('bankaccount_id')->references('id')->on('bankaccounts')->onDelete('cascade');
            $table->primary(['admin_id', 'bankaccount_id']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('administrator_bankaccount');
    }
};
