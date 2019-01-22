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
            $table->string('voornaam');
            $table->string('achternaam'); 
            $table->string('groepsnaam');
            $table->string('email'); 
            $table->string('adres'); 
            $table->string('postcode'); 
            $table->string('stad'); 
            $table->string('land');
            $table->timestamps();
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
