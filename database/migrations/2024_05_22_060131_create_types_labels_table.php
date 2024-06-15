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
        Schema::create('types_labels', function (Blueprint $table) {
            $table->integer('type_id')->unsigned()->nullable(false);
            $table->integer('language_id')->unsigned()->nullable(false);
            $table->string('name', 50)->nullable(false)->default('');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('types_labels');
    }
};
