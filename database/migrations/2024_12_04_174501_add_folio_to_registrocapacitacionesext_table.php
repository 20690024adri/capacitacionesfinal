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
        Schema::table('registrocapacitacionesext', function (Blueprint $table) {
            $table->string('folio')->nullable(); // Reemplaza 'status' con la columna previa a 'folio' en tu tabla
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('registrocapacitacionesext', function (Blueprint $table) {
            $table->dropColumn('folio');
        });
    }
};
