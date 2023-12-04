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
        Schema::table('accounts', function (Blueprint $table) {
            $table->integer('sick_leave')->default(30)->after('position_id'); // ลาป่วย
            $table->integer('personal_leave')->default(6)->after('sick_leave'); // ลากิจ
            $table->integer('vacation_leave')->nullable()->after('personal_leave'); // ลาพักร้อน
            $table->integer('maternity_leave')->default(90)->after('vacation_leave'); // ลาคลอด
            $table->integer('ordination_leave')->default(120)->after('maternity_leave'); // ลาบวช
            $table->date('start_job')->nullable()->after('ordination_leave');// วันเริ่มงาน
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('accounts', function (Blueprint $table) {
            //$table->dropColumn('user_id');
        });
    }
};
