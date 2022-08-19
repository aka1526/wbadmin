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
        Schema::create('slidesimg', function (Blueprint $table) {
            $table->biginteger('unid')->primary();
            $table->string('slidesimg_img',200)->default('')->nullable();
            $table->string('slidesimg_desc',200)->default('')->nullable();
            $table->string('slidesimg_status',50)->default('')->nullable();
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
        Schema::dropIfExists('slidesimg');
    }
};
