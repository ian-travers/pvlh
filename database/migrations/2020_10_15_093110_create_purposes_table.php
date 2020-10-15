<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePurposesTable extends Migration
{
    public function up()
    {
        Schema::create('purposes', function (Blueprint $table) {
            $table->id();
            $table->string('name', 40);
        });
    }

    public function down()
    {
        Schema::dropIfExists('purposes');
    }
}
