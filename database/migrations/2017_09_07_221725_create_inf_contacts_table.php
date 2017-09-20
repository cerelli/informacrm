<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateInfContactsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('inf_contacts', function (Blueprint $table) {
            $table->increments('id');

            $table->unsignedInteger('inf_title_id')->nullable();

            $table->string('first_name', 30);
            $table->string('last_name', 30);
            $table->text('notes')->nullable();

            $table->unsignedInteger('inf_account_id')->nullable();
            $table->unsignedInteger('inf_contact_type_id')->nullable();
            $table->unsignedInteger('inf_office_id')->nullable();

            $table->string('created_by', 60)->default('');
            $table->string('updated_by', 60)->default('');
            $table->softDeletes();
            $table->timestamps();

            $table->foreign('inf_title_id')->references('id')->on('inf_titles')->onDelete('restrict')->onUpdate('cascade');
            $table->foreign('inf_account_id')->references('id')->on('inf_accounts')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('inf_contact_type_id')->references('id')->on('inf_contact_types')->onDelete('restrict')->onUpdate('cascade');
            $table->foreign('inf_office_id')->references('id')->on('inf_offices')->onDelete('restrict')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('inf_contacts');
    }
}
