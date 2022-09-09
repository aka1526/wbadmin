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
        Schema::create('websubmenu', function (Blueprint $table) {
            $table->biginteger('unid')->primary();
            $table->biginteger('menu_ref_unid')->nullable();
            $table->string('submenu_th_name',200)->nullable()->default('');
            $table->string('submenu_en_name',200)->nullable()->default('');
            $table->string('submenu_url',200)->nullable()->default('');
            $table->string('submenu_status',50)->nullable()->default('');
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
        Schema::dropIfExists('websubmenu');
    }
};
