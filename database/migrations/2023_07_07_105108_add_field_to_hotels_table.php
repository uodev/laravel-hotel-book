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
        Schema::table('hotels', function (Blueprint $table) {
            $table->string('email')->nullable();
            $table->string('password')->nullable();
            $table->dropColumn('price');
            $table->dropColumn('pensionType');
            $table->string('city');

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('hotels', function (Blueprint $table) {
            $table->dropColumn('email');
            $table->dropColumn('password');
            $table->integer('price');
            $table->string('pensionType');
            $table->dropColumn('city');
        });
    }
};
