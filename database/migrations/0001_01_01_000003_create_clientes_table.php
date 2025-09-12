<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('clientes', function (Blueprint $table) {
            $table->id();
            $table->string('nombre');
            $table->string('email_contacto')->unique();
            $table->string('razon_social');
            $table->string('rut_empresa')->unique();
            $table->string('rubro');
            $table->string('telefono');
            $table->string('direccion');
            $table->string('contacto');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('clientes');
    }
};
