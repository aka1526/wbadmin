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
        Schema::table('customerlist', function (Blueprint $table) {
            $table->string('cus_name',200)->nullable()->default('');
            $table->string('cus_middle',200)->nullable()->default('');
            $table->string('cus_img',200)->nullable()->default('');
            $table->string('cus_status',50)->nullable()->default('Y');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('customerlist', function (Blueprint $table) {
            //
        });
    }
};
