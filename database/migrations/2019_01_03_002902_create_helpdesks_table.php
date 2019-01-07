<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

/**
 * Class CreateHelpdesksTable
 */
class CreateHelpdesksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up(): void
    {
        Schema::create('helpdesks', function (Blueprint $table): void {
            $table->increments('id');
            $table->unsignedInteger('created_by')->nullable();
            $table->unsignedInteger('assigned')->nullable();
            $table->boolean('is_open')->default(1); // True is the default boolean value.
            $table->string('titel'); 
            $table->string('categorie'); 
            $table->text('beschrijving');
            $table->timestamps();

            // Foreign key constraints
            $table->foreign('created_by')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('assigned')->references('id')->on('users')->onDelete('SET NULL');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down(): void
    {
        Schema::dropIfExists('helpdesks');
    }
}
