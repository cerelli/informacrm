<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateInfDocumentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('inf_documents', function (Blueprint $table) {
            $table->increments('id');
            $table->text('description')->nullable();
            $table->datetime('expiration_date')->nullable();

            $table->string('version', 40)->nullable();
            $table->boolean('extracted')->default(0);

            $table->unsignedInteger('inf_account_id')->nullable();
            $table->unsignedInteger('inf_document_status_id')->nullable();

            $table->string('path')->nullable();
            $table->string('preview')->nullable();
            $table->string('name')->nullable();
            $table->string('type')->nullable();
            $table->string('disk')->nullable();
            $table->string('hash', 40)->nullable();
            $table->unsignedInteger('size');
            $table->unsignedInteger('width')->nullable();
            $table->unsignedInteger('height')->nullable();

            $table->string('created_by', 60);
            $table->string('updated_by', 60)->default('');
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('inf_documents');
    }
}
