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
        Schema::create('tb_question', function (Blueprint $table) {
            $table->id();
            $table->string('grade');              // 7, 8, 9
            $table->text('q');                    // pertanyaan
            $table->json('items');                // array noisy
            $table->json('correct');              // array benar
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
        Schema::dropIfExists('tb_question');
    }
};
