<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

/**
 * Class CreateBillingsTable
 */
class CreateBillingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up(): void
    {
        Schema::create('billings', function (Blueprint $table): void {
            $table->increments('id');
            $table->unsignedInteger('user_id');
            $table->string('voornaam')->nullable();
            $table->string('achternaam')->nullable();
            $table->string('groepsnaam')->nullable();
            $table->string('email')->nullable();
            $table->string('adres')->nullable();
            $table->string('postcode')->nullable();
            $table->string('stad')->nullable();
            $table->string('land')->nullable();
            $table->timestamps();

            // Foreign key constraints
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down(): void
    {
        Schema::dropIfExists('billings');
    }
}
