<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class () extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('reservations', function (Blueprint $table) {
            $table->id('reservation_id');
            $table->string('name', length:50)->nullable()->default('');
            $table->string('mobile', length:25)->nullable()->default('');
            $table->integer('type_id')->unsigned()->default(0);
            $table->enum('location_type', ['indoor', 'outdoor'])->nullable(false)->default('indoor');
            $table->float('price')->nullable(false)->default(0);
            $table->float('price_remaining')->nullable(false)->default(0);
            $table->integer('photographer')->unsigned()->nullable(false)->default(0);
            $table->integer('status_id')->unsigned()->default(0);
            $table->boolean('has_video')->nullable(false)->default(false);
            $table->date('date')->nullable(false);
            $table->time('start')->nullable(false);
            $table->time('end')->nullable(false);
            $table->text('note')->nullable(true);
            $table->integer('added_by')->unsigned()->nullable(false)->default(0);
            $table->integer('updated_by')->unsigned()->nullable(false)->default(0);
            $table->timestamp('created_at')->default(DB::raw('CURRENT_TIMESTAMP'));
            $table->timestamp('updated_at')->default(DB::raw('CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP'));

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('reservations');
    }
};
