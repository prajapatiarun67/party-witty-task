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
        Schema::create('transactions', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('consumer_id')->index();
            $table->unsignedBigInteger('product_id')->index();
            $table->enum('transaction_type', ['Issue', 'Return'])->notNull();
            $table->integer('quantity')->notNull();
            $table->foreign('consumer_id')
                  ->references('id')
                  ->on('consumers')
                  ->onDelete('cascade');
            $table->foreign('product_id')
                  ->references('id')
                  ->on('product')
                  ->onDelete('cascade');
            $table->timestamp('transaction_date')->useCurrent();
            $table->text('notes')->nullable();
            $table->softDeletes();
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
        Schema::dropIfExists('transactions');
    }
};
