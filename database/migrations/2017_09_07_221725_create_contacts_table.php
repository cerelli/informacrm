<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateContactsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('contacts', function (Blueprint $table) {
            $table->increments('id');

            $table->unsignedInteger('title_id')->nullable();

            $table->string('first_name', 30)->default('');
            $table->string('last_name', 30)->default('');
            $table->text('notes')->nullable();

            $table->unsignedInteger('account_id')->nullable();
            $table->unsignedInteger('contact_type_id')->nullable();
            $table->unsignedInteger('office_id')->nullable();

            $table->string('created_by', 60)->default('');
            $table->string('updated_by', 60)->default('');
            $table->softDeletes();
            $table->timestamps();

            $table->foreign('title_id')->references('id')->on('titles')->onDelete('restrict')->onUpdate('cascade');
            $table->foreign('account_id')->references('id')->on('accounts')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('contact_type_id')->references('id')->on('contact_types')->onDelete('restrict')->onUpdate('cascade');
            $table->foreign('office_id')->references('id')->on('offices')->onDelete('restrict')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('contacts');
    }
}
