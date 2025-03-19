<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('categories', function (Blueprint $table) {
            $table->id();
            $table->string('name', 100)->unique();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        DB::statement('SET FOREIGN_KEY_CHECKS=0;'); // Matikan foreign key sementara
        Schema::dropIfExists('items'); // Hapus tabel anak dulu (kalau ada)
        Schema::dropIfExists('categories'); // Baru hapus tabel induk
        DB::statement('SET FOREIGN_KEY_CHECKS=1;'); // Aktifkan lagi foreign key
    }
};
