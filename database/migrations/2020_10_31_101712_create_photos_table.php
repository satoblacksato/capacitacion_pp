<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePhotosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('photos', function (Blueprint $table) {
            $table->id();
            $table->string('name',40);
            $table->boolean('enabled')->default(true);
            $table->unsignedBigInteger('created_user');
            $table->unsignedBigInteger('updated_user');
            $table->unsignedBigInteger('book_id');
            $table->string('created_ip',20);
            $table->string('updated_ip',20);
            $table->timestamps();

            $table->foreign('book_id')->references('id')->on('books');
            $table->foreign('created_user')->references('id')->on('users');
            $table->foreign('updated_user')->references('id')->on('users');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('photos');
    }
}
