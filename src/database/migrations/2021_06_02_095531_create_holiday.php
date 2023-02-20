<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateHoliday extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('holiday', function (Blueprint $table) {
            $table->increments('id')->comment('ID:主キー、自動採番');
            $table->unsignedInteger('status_no')->comment('状況No');
            $table->date('add_date')->comment('申請日');
            $table->string('staff_name')->comment('スタッフ名');
            $table->string('section')->nullable()->default(NULL)->comment('スタッフ部署');
            $table->text('memo')->nullable()->default(NULL)->comment('詳細');
            $table->date('paid_start')->nullable()->comment('休暇開始日');
            $table->date('paid_end')->nullable()->comment('休暇終了日');
            $table->string('tel')->nullable()->comment('連絡先');
            $table->unsignedInteger('holiday_type')->nullable()->default(NULL)->comment('休暇種別');
            $table->unsignedInteger('paid_type')->nullable()->default(NULL)->comment('有給種別');
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
        Schema::dropIfExists('holiday');
    }
}
