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
        Schema::create('leaves', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('leave_type_id')->unsigned()->index()->nullable();
            $table->bigInteger('account_id')->unsigned()->index()->nullable();
            $table->dateTime('leave_start_date')->nullable();
            $table->dateTime('leave_end_date')->nullable();
            $table->text('leave_reason')->nullable();
            $table->tinyInteger('status')->nullable();
            $table->text('status_remark')->nullable();       
            $table->timestamps();

            $table->foreign('leave_type_id')->references('id')->on('leave_types')->cascadeOnDelete();
            $table->foreign('account_id')->references('id')->on('users')->cascadeOnDelete();

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('leaves');
    }
};
