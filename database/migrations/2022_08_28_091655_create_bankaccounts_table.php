<?php

// Facades.
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
        Schema::create('bankaccounts', function (Blueprint $table) {
            // Generate ID.
            $table->id();

            // Relations.
            $table->bigInteger('bankaccount_types_id')->unsigned()->index();
            $table->foreign('bankaccount_types_id')->references('id')->on('bankaccount_types')->onDelete('cascade');

            // Table content.
            $table->string('name');
            $table->string('accountnumber')->unique();

            // Generate timestaps (created_at, updated_at).
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
        Schema::dropIfExists('bankaccounts');
    }
};
