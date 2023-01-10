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
        Schema::create('customer', function (Blueprint $table) {
            $table->biginteger('unid')->primary();
            $table->string('customer_group',200)->nullable()->default('');
            $table->string('customer_name',200)->nullable()->default('');
            $table->string('customer_middle',200)->nullable()->default('');
            $table->string('customer_url',200)->nullable()->default('');
            $table->string('customer_logo',200)->nullable()->default('');
            $table->string('customer_status',50)->nullable()->default('');

            $table->string('create_by',200)->nullable()->default('');
            $table->string('create_time',50)->nullable()->default('');
            $table->string('modify_by',200)->nullable()->default('');
            $table->string('modify_time',50)->nullable()->default('');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('customer');
    }
};
