<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRecordsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('records', function (Blueprint $table) {
            $table->increments('record_id')->start_from(1);
            $table->string('user_id');
            $table->string('device_id');
            $table->integer('record_amount');
            $table->integer('auditors_id'); // 審核員_id
            $table->string('record_dateOfReturn'); // 歸還日期
            $table->string('record_content');
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
        Schema::dropIfExists('records');
    }
}
