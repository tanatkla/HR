<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->string('firstname', 40)->nullable()->after('password');
            $table->string('lastname', 40)->nullable()->after('firstname');
            $table->boolean('check_password', 40)->default(0)->nullable()->after('lastname');
            $table->bigInteger('position_id')->unsigned()->index()->nullable()->after('check_password');
            $table->integer('sick_leave')->default(240)->after('position_id'); // ลาป่วย
            $table->integer('personal_leave')->default(40)->after('sick_leave'); // ลากิจ
            $table->integer('vacation_leave')->nullable()->after('personal_leave'); // ลาพักร้อน
            $table->integer('vacation_leave_total')->nullable()->after('vacation_leave'); // ลาพักร้อน
            $table->integer('maternity_leave')->default(784)->after('vacation_leave'); // ลาคลอด
            $table->integer('training_leave')->default(80)->after('maternity_leave'); // ลาฝึกอบรม
            $table->date('start_job')->nullable()->after('training_leave');// วันเริ่มงาน

            $table->foreign('position_id')->references('id')->on('positions')->cascadeOnDelete();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('users', function (Blueprint $table) {
            //
        });
    }
};
