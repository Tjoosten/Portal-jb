<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateNoteLeasesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up(): void
    {
        Schema::create('note_leases', function (Blueprint $table): void {
            $table->increments('id');
            $table->unsignedInteger('author_id')->nullable()->index();
            $table->unsignedInteger('lease_id')->index();
            $table->string('titel');
            $table->text('beschrijving');
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
        Schema::dropIfExists('note_leases');
    }
}
