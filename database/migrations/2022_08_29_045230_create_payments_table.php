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
        Schema::create('payments', function (Blueprint $table) {
            // Generate ID.
            $table->id();

            // Relations.
            $table->bigInteger('payment_type_id')->unsigned()->index();
            $table->foreign('payment_type_id')->references('id')->on('payment_types')->onDelete('cascade');

            // Table content.
            $table->string('name');

            // Generate timestamps (created_at, updated_at)
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('payments');
    }
};
