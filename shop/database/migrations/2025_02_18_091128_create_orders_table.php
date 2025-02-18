<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            // Si tu pedido está asociado a un usuario:
            $table->unsignedBigInteger('user_id')->nullable();

            // Status del pedido, por ejemplo: 'pending', 'paid', 'shipped', etc.
            $table->string('status')->default('pending');

            // Total del pedido
            $table->decimal('total', 10, 2)->default(0);

            $table->timestamps();

            // Foreign Key: Si deseas enlazar con la tabla users
            $table->foreign('user_id')
                  ->references('id')
                  ->on('users')
                  ->onDelete('set null'); 
        });
    }

    public function down()
    {
        Schema::dropIfExists('orders');
    }
};
