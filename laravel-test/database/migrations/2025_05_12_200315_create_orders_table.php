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
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->string('name', 255)->nullable();                        // name VARCHAR(255) NULL
            $table->string('email', 30)->nullable();                        // email VARCHAR(30) NULL
            $table->string('phone', 20)->nullable();                        // phone VARCHAR(20) NULL
            $table->double('amount')->nullable();                           // amount DOUBLE NULL
            $table->text('address')->nullable();                            // address TEXT NULL
            $table->string('status', 10)->nullable();                       // status VARCHAR(10) NULL
            $table->string('transaction_id', 255)->nullable();              // transaction_id VARCHAR(255) NULL
            $table->string('currency', 20)->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('orders');
    }
};
