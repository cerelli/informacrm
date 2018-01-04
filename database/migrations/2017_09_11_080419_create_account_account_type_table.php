<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAccountAccountTypeTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('account_account_type', function (Blueprint $table) {
            $table->integer('account_id')->unsigned();
            $table->integer('account_type_id')->unsigned();
            $table->nullableTimestamps();
            $table->softDeletes();

            $table->primary(['account_id', 'account_type_id']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('account_account_type');
    }
}
