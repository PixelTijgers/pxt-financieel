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
        Schema::create('fixed_costs', function (Blueprint $table) {
            // Generate ID.
            $table->id();

            // Relations.
            $table->bigInteger('fiscal_year_id')->unsigned()->index();
            $table->foreign('fiscal_year_id')->references('id')->on('fiscal_years')->onDelete('cascade');

            $table->bigInteger('bankaccount_id')->unsigned()->index();
            $table->foreign('bankaccount_id')->references('id')->on('bankaccounts')->onDelete('cascade');

            $table->bigInteger('category_id')->unsigned()->index();
            $table->foreign('category_id')->references('id')->on('categories')->onDelete('cascade');

            $table->bigInteger('company_id')->unsigned()->index();
            $table->foreign('company_id')->references('id')->on('companies')->onDelete('cascade');

            // Table content.
            // $table->string('name');
            $table->decimal('cost', 9, 3)->default(0);
            $table->integer('is_shared')->unsigned()->default(0);

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
        Schema::dropIfExists('fixed_costs');
    }
};
