<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('szallodak', function (Blueprint $table) {
            $table->string('az', 5)->primary();
            $table->string('nev');
            $table->unsignedTinyInteger('besorolas');
            $table->string('helyseg_az', 5);
            $table->unsignedInteger('tengerpart_tav')->default(0);
            $table->unsignedInteger('repter_tav')->default(0);
            $table->boolean('felpanzio')->default(false);
            $table->foreign('helyseg_az')->references('az')->on('helysegek')->restrictOnDelete();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('szallodak');
    }
};
