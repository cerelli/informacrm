<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateInfContactDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('inf_contact_details', function (Blueprint $table) {
            $table->increments('id');

            $table->string('value', 255);
            $table->text('notes')->nullable();

            $table->unsignedInteger('inf_contact_id')->nullable();
            $table->unsignedInteger('inf_contact_detail_type_id')->nullable();
            $table->unsignedInteger('inf_communication_type_id')->nullable();

            $table->string('created_by', 60)->default('');
            $table->string('updated_by', 60)->default('');
            $table->softDeletes();
            $table->timestamps();

            $table->foreign('inf_contact_id')->references('id')->on('inf_contacts')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('inf_contact_detail_type_id')->references('id')->on('inf_contact_detail_types')->onDelete('restrict')->onUpdate('cascade');
            $table->foreign('inf_communication_type_id')->references('id')->on('inf_communication_types')->onDelete('restrict')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('inf_contact_details');
    }
}
