<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEventWeekdaysTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('event_weekdays', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('event_id');
            $table->date('eventdate');
            $table->integer('dayofweeknum');
            $table->string('dayofweek');
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
        Schema::dropIfExists('event_weekdays');
    }
}
