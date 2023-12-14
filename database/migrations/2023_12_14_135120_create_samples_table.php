<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('samples', function (Blueprint $table) {
            $table->engine = 'MyISAM';
            $table->unsignedSmallInteger('id_alternative');
            $table->unsignedTinyInteger('id_criteria');
            $table->float('value');
            $table->timestamps();

            $table->primary(['id_alternative', 'id_criteria']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('evaluations');
    }
};
