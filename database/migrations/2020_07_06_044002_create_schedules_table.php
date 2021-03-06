<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSchedulesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('schedules', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('title');//タイトル
            $table->boolean('all_day');//終日 
            $table->datetime('start_date');//開始日
            $table->datetime('end_date');//終了日
            $table->boolean('notification_flag');//通知フラグ
            $table->string('notification');//通知
            $table->boolean('repetition_flag');//繰り返しフラグ
            $table->Integer('repetition');//繰り返し
            $table->string('memo')->nullable();//メモ
            $table->string('color');//色
            $table->string('place')->nullable();//場所
            $table->string('url')->nullable();//URL
            $table->unsignedBigInteger('calendar_id');//カレンダーID
            $table->timestamps();

            //外部キー
            $table->foreign('calendar_id')
                ->references('id')
                ->on('calendars')
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
        Schema::dropIfExists('schedules');
    }
}
