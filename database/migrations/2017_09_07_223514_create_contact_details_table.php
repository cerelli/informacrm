<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateContactDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('contact_details', function (Blueprint $table) {
            $table->increments('id');

            $table->string('value', 255);
            $table->text('notes')->nullable();

            $table->unsignedInteger('contact_id')->nullable();
            $table->unsignedInteger('contact_detail_type_id')->nullable();
            $table->unsignedInteger('communication_type_id')->nullable();

            $table->string('created_by', 60)->default('');
            $table->string('updated_by', 60)->default('');
            $table->softDeletes();
            $table->timestamps();

            $table->foreign('contact_id')->references('id')->on('contacts')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('contact_detail_type_id')->references('id')->on('contact_detail_types')->onDelete('restrict')->onUpdate('cascade');
            $table->foreign('communication_type_id')->references('id')->on('communication_types')->onDelete('restrict')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('contact_details');
    }
}
