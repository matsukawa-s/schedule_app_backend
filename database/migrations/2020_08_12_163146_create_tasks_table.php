<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTasksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tasks', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('task_name');//タスク名
            $table->boolean('status');//状態　0:未完了, 1:完了
            $table->datetime('date')->nullable();//タスク日
            $table->unsignedBigInteger('taskgroup_id');//タスクグループID
            $table->unsignedBigInteger('user_id');//ユーザーID(作成者)
            $table->timestamps();

            //外部キー
            $table->foreign('taskgroup_id')
                ->references('id')
                ->on('taskgroups')
                ->onDelete('cascade');

            $table->foreign('user_id')
                ->references('id')
                ->on('users')
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
        Schema::dropIfExists('tasks');
    }
}
