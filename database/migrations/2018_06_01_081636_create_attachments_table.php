<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAttachmentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('attachments', function (Blueprint $table) {
            $table->increments('id');
            $table->string('title', 255);
            $table->string('original_name', 255);
            $table->string('fisical_name', 255);
            $table->string('disk', 255);
            $table->string('path', 255);

            $table->string('type');
            $table->string('extension');
            $table->unsignedInteger('size');

            $table->unsignedInteger('extraction_id')->nullable()->index();
            $table->unsignedInteger('version')->index();

            $table->unsignedInteger('created_by')->nullable();
            $table->unsignedInteger('updated_by')->nullable();
            $table->unsignedInteger('deleted_by')->nullable();

            $table->softDeletes();
            $table->timestamps();

            $table->foreign('created_by', 'attach_user_id_createfor')->references('id')->on('users')->onUpdate('NO ACTION')->onDelete('RESTRICT');
            $table->foreign('updated_by', 'attach_user_id_updatefor')->references('id')->on('users')->onUpdate('NO ACTION')->onDelete('RESTRICT');
            $table->foreign('deleted_by', 'attach_user_id_deletefor')->references('id')->on('users')->onUpdate('NO ACTION')->onDelete('RESTRICT');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('attachments');
    }
}
