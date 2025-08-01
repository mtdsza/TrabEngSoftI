<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{

    public function up(): void
    {
        Schema::create('procedimentos', function (Blueprint $table) {
            $table->id('id_procedimento');
            $table->string('nome', 255);
            $table->decimal('valor_padrao', 10, 2)->default(0.00);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('procedimentos');
    }
};
