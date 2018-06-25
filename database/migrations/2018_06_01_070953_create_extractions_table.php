<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateExtractionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('extractions', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('attachment_id');
            $table->unsignedInteger('extracted_by');
            $table->datetime('extracted_at');

            $table->unsignedInteger('archived_by')->nullable();
            $table->datetime('archived_at')->nullable();

            $table->foreign('extracted_by', 'extraction_user_id')->references('id')->on('users')->onUpdate('NO ACTION')->onDelete('RESTRICT');
            $table->foreign('archived_by', 'archive_user_id')->references('id')->on('users')->onUpdate('NO ACTION')->onDelete('RESTRICT');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('extractions');
    }
}
