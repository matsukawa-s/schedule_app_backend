<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTaskgroupsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('taskgroups', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('taskgroup_name');//タスクグループ名
            $table->string('color');//カラー
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
        Schema::dropIfExists('taskgroups');
    }
}
