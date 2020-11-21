<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCategoriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('categories', function (Blueprint $table) {
            $table->id();
            $table->string('name',40);
            $table->string('description',200);
            $table->string('photo',40)->nullable();
            $table->boolean('enabled')->default(true);
            $table->unsignedBigInteger('created_user');
            $table->unsignedBigInteger('updated_user');
            $table->string('created_ip',20);
            $table->string('updated_ip',20);
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
        Schema::dropIfExists('categories');
    }
}
