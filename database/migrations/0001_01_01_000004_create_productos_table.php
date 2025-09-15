<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('productos', function (Blueprint $table) {
            $table->id();
            $table->string('sku')->unique();
            $table->string('nombre');
            $table->string('descripcion_corta');
            $table->text('descripcion_larga');
            $table->string('imagen_url')->nullable();
            $table->integer('precio_neto');
            $table->integer('precio_venta');
            $table->integer('stock_actual');
            $table->integer('stock_minimo');
            $table->boolean('stock_bajo')->default(false);
            $table->integer('stock_alto');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('productos');
    }
};