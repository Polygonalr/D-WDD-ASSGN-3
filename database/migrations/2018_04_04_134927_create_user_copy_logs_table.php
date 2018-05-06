<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUserCopyLogsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('user_copy_logs', function (Blueprint $table) {
            $table->increments("id");
            $table->integer('copy_id')->unsigned()->index();
            $table->foreign('copy_id')->references('id')->on('copies')->onDelete('cascade');
            $table->integer('user_id')->unsigned()->index();
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            //$table->primary(['copy_id', 'user_id']);
            $table->dateTime("date_borrowed")->default(DB::raw('CURRENT_TIMESTAMP'));
            $table->dateTime("date_returned")->nullable();
            $table->boolean("fines_paid")->nullable();
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
        Schema::dropIfExists('user_copy_logs');
    }
}
