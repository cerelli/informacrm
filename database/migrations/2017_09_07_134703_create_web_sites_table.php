<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateWebSitesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('web_sites', function (Blueprint $table) {
            $table->increments('id');
            $table->string('url',60);
            $table->unsignedInteger('web_site_type_id');

            $table->unsignedInteger('account_id');
            $table->text('notes')->nullable();
            $table->string('created_by', 60)->default('');
            $table->string('updated_by', 60)->default('');
            $table->softDeletes();
            $table->timestamps();

            $table->foreign('web_site_type_id')->references('id')->on('web_site_types')->onDelete('restrict')->onUpdate('cascade');
            $table->foreign('account_id')->references('id')->on('accounts')->onDelete('cascade')->onUpdate('cascade');
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
        Schema::dropIfExists('web_sites');
        Schema::disableForeignKeyConstraints();
    }
}
