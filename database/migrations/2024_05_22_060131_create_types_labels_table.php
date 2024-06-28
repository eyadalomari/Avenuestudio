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
        Schema::create('types_i18n', function (Blueprint $table) {
            $table->id();
            $table->foreignId('type_id')->constrained('types')->onDelete('cascade');
            $table->integer('language_id')->unsigned()->nullable(false);
            $table->string('name', 50)->nullable(false)->default('');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('types_i18n');
    }
};
