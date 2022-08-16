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
        Schema::create('news', function (Blueprint $table) {
            $table->biginteger('unid')->primary();
            $table->string('doc_type',50)->default('')->nullable();
            $table->string('new_date',50)->nullable();
            $table->string('img_group',50)->default('')->nullable();
            $table->string('img_thumb',200)->default('')->nullable();
            $table->string('new_th_title',500)->default('')->nullable();
            $table->mediumText('new_th_detail')->default('')->nullable();
            $table->string('new_en_title',500)->default('')->nullable();
            $table->mediumText('new_en_detail')->default('')->nullable();
            $table->string('new_status',50)->default('Y')->nullable();
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
        Schema::dropIfExists('news');
    }
};
