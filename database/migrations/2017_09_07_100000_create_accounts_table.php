<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAccountsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('accounts', function (Blueprint $table) {
            $table->increments('id');

            $table->unsignedInteger('title_id')->nullable();

            $table->boolean('is_person')->default(0);
            $table->string('name1', 60);
            $table->string('name2', 60)->default('')->nullable();
            $table->text('notes')->nullable();

            $table->string('vat_number',11)->default('')->nullable();
            $table->string('fiscal_code',16)->default('')->nullable();
            $table->boolean('is_blocked')->default(0);
            $table->string('block_alert_msg', 255)->default('')->nullable();

            $table->string('created_by', 60)->default('');
            $table->string('updated_by', 60)->default('');
            $table->softDeletes();
            $table->timestamps();

            $table->foreign('title_id')->references('id')->on('titles')->onDelete('set null')->onUpdate('cascade');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::disableForeignKeyConstraints();
        Schema::dropIfExists('accounts');
        Schema::enableForeignKeyConstraints();
    }
}
