<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('item_features', function (Blueprint $table) {
            $table->id();
            $table->foreignId('item_id')->constrained('items')->cascadeOnDelete();
            $table->string('text', 255);
            $table->unsignedSmallInteger('sort_order')->default(0);
            $table->timestamps();

            $table->index('item_id');
            $table->unique(['item_id', 'sort_order']);
            if (DB::getDriverName() === 'mysql') {
                $table->fullText('text');
            }
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('item_features');
    }
};
