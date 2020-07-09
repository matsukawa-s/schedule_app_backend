<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CalendarExtensionTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('calendar_extension', function (Blueprint $table) {
            $table->bigIncrements('id');

            $table->unsignedBigInteger('calendar_id');//カレンダーID
            $table->unsignedBigInteger('extension_id');//拡張機能ID
            $table->timestamps();

            //外部キー
            $table->foreign('calendar_id')
                ->references('id')
                ->on('calendars')
                ->onDelete('cascade');

            $table->foreign('extension_id')
                ->references('id')
                ->on('extensions')
                ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('calendar_extension');
    }
}
