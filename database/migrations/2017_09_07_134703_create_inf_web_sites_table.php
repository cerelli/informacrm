<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateInfWebSitesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('inf_web_sites', function (Blueprint $table) {
            $table->increments('id');
            $table->string('url',60);
            $table->unsignedInteger('inf_web_site_type_id');

            $table->unsignedInteger('inf_account_id');
            $table->text('notes')->nullable();
            $table->string('created_by', 60)->default('');
            $table->string('updated_by', 60)->default('');
            $table->softDeletes();
            $table->timestamps();

            $table->foreign('inf_web_site_type_id')->references('id')->on('inf_web_site_types')->onDelete('restrict')->onUpdate('cascade');
            $table->foreign('inf_account_id')->references('id')->on('inf_accounts')->onDelete('restrict')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::enableForeignKeyConstraints();
        Schema::dropIfExists('inf_web_sites');
        Schema::disableForeignKeyConstraints();
    }
}
