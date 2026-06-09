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
        Schema::table('krs', function (Blueprint $table) {
            $table->char('npm', 10)->after('id');
            $table->char('kode_matakuliah', 8)->after('npm');

            $table->foreign('npm')
            ->references('npm')
            ->on('mahasiswa')
            ->onUpdate('cascade')
            ->onDelete('cascade');

            $table->foreign('kode_matakuliah')
            ->references('kode_matakuliah')
            ->on('matakuliah')
            ->onUpdate('cascade')
            ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('krs', function (Blueprint $table) {
            //
        });
    }
};
