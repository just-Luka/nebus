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
        Schema::create('buildings', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->string('address_line', 150);
            $table->string('city', 150);
            $table->string('country', 150);
            $table->decimal('latitude', 10, 7);
            $table->decimal('longitude', 10, 7);
        });

        Schema::table('organisations', function (Blueprint $table) {
            $table->foreign('building_id')
                ->references('id')
                ->on('buildings')
                ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('organisations', function (Blueprint $table) {
            $table->dropForeign(['building_id']);
        });

        Schema::dropIfExists('buildings');
    }
};
