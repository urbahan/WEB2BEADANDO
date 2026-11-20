<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('tavasz', function (Blueprint $table) {
            $table->id();
            $table->string('szalloda_az', 5);
            $table->date('indulas');
            $table->unsignedTinyInteger('idotartam');
            $table->unsignedInteger('ar');
            $table->foreign('szalloda_az')->references('az')->on('szallodak')->cascadeOnDelete();
            $table->index(['indulas', 'ar']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('tavasz');
    }
};
