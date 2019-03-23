<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

/**
 * Class CreateLeasesTable
 */
class CreateLeasesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up(): void
    {
        Schema::create('leases', function (Blueprint $table): void {
            $table->increments('id');
            $table->unsignedInteger('tenant_id')->nullable();
            $table->foreign('tenant_id')->references('id')->on('users')->onDelete('cascade');
            $table->integer('aantal_personen');
            $table->string('status')->default('Nieuwe aanvraag');
            $table->date('start_datum')->nullable()->default(null)->comment('Datum formaat: Y-m-d');
            $table->date('eind_datum')->nullable()->default(null)->comment('Datum formaat: Y-m-d');
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
        Schema::dropIfExists('leases');
    }
}
