<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLocomotiveApplicationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('locomotive_applications', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id')->references('id')->on('users');
            $table->unsignedBigInteger('customer_id')->references('id')->on('customers');
            $table->unsignedTinyInteger('sections');
            $table->unsignedTinyInteger('hours');
            $table->unsignedTinyInteger('count');
            $table->timestamp('on_date');
            $table->text('description');
            $table->unsignedBigInteger('purpose_id')->references('id')->on('purposes');
            $table->unsignedBigInteger('depot_id')->references('id')->on('depots');
            $table->boolean('is_nodt')->default(false);
            $table->boolean('is_nodn')->default(false);
            $table->boolean('is_nodshp')->default(false);
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
        Schema::dropIfExists('locomotive_applications');
    }
}
