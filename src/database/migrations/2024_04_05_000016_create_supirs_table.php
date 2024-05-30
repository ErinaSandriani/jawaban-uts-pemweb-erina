<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSupirsTable extends Migration
{
    public function up()
    {
        Schema::create('supirs', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name')->nullable();
            $table->string('alamat')->nullable();
            $table->string('no')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }
}
