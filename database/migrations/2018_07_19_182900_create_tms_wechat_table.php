<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTmsWechatTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('wechat', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('mobile_id')->comment('关联手机')->nullable();
            $table->string('name', 20)->comment('姓名');
            $table->string('mobile', 11)->comment('手机号');
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
        Schema::dropIfExists('wechat');
    }
}
