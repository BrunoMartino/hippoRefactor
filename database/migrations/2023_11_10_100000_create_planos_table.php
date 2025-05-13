
<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('planos', function (Blueprint $table) {
            $table->id();
            $table->foreignId('modulo_id')->constrained()->cascadeOnDelete();
            $table->string('nome');
            $table->integer('limite_mensagens');
            $table->decimal('valor', 10, 2);
            $table->integer('qtd_usuarios');
            $table->integer('qtd_instancias');
            $table->string('icon')->default('assets/images/pngs/fogo.png');
            $table->string('color')->default('#0853FC');
            $table->decimal('custo_excedente', 10, 3)->default(0);
            $table->softDeletes();
            $table->timestamps();

        });
    }

    public function down(): void
    {
        Schema::dropIfExists('planos');
    }
};
