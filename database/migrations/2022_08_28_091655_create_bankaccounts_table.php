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
            $table->bigInteger('bankaccount_type_id')->unsigned()->index();
            $table->foreign('bankaccount_type_id')->references('id')->on('bankaccount_types')->onDelete('cascade');

            // Table content.
            $table->string('name');
            $table->string('accountnumber')->unique();
            $table->decimal('balance', 9, 3)->default(0);
            $table->integer('is_shared')->unsigned()->default(0);

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
