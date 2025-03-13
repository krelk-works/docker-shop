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
        Schema::table('shoes', function (Blueprint $table) {
            $table->boolean('featured')->default(false)->after('image'); // Campo destacado (true/false)
            $table->unsignedTinyInteger('discount')->default(0)->after('featured'); // Campo de oferta (0-100)
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('shoes', function (Blueprint $table) {
            $table->dropColumn(['featured', 'discount']);
        });
    }
};
