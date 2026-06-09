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
        Schema::table('jadwal', function (Blueprint $table) {
            $table->char('kode_matakuliah',10)->after('id');
            $table->char('nidn',10)->after('kode_matakuliah');

            $table->foreign('kode_matakuliah')
            ->references('kode_matakuliah')
            ->on('matakuliah')
            ->onUpdate('cascade')
            ->onDelete('cascade');
            
            $table->foreign('nidn')
            ->references('nidn')
            ->on('dosen')
            ->onUpdate('cascade')
            ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('jadwal', function (Blueprint $table) {
            $table->dropForeign(['kode_matakuliah']);
            $table->dropForeign(['nidn']);
            $table->dropColumn('kode_matakuliah');
            $table->dropColumn('nidn');
        });
    }
};
