<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use DB;

class ModifyDocumentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('documents', function($table) {
            $table->dropColumn('path');
            $table->dropColumn('preview');
            $table->dropColumn('name');
            $table->dropColumn('type');
            $table->dropColumn('disk');
            $table->dropColumn('hash');
            $table->dropColumn('size');
            $table->dropColumn('width');
            $table->dropColumn('height');

            $table->dropColumn('created_by');
            $table->dropColumn('updated_by');

            $table->renameColumn('inf_account_id', 'account_id');
            $table->renameColumn('inf_document_status_id', 'document_status_id');
        });
        Schema::table('documents', function($table) {
            $table->unsignedInteger('document_type_id')->nullable();

            $table->integer('created_by')->unsigned()->nullable()->after('document_status_id');
            $table->integer('updated_by')->unsigned()->nullable()->after('created_by');
            $table->integer('deleted_by')->unsigned()->nullable()->after('updated_by');
        });
        Schema::table('documents', function($table) {
            $table->foreign('created_by', 'documents_user_id_createfor')->references('id')->on('users')->onUpdate('NO ACTION')->onDelete('RESTRICT');
            $table->foreign('updated_by', 'documents_user_id_updatefor')->references('id')->on('users')->onUpdate('NO ACTION')->onDelete('RESTRICT');
            $table->foreign('deleted_by', 'documents_user_id_deletefor')->references('id')->on('users')->onUpdate('NO ACTION')->onDelete('RESTRICT');

            $table->foreign('account_id')->references('id')->on('accounts')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('document_status_id')->references('id')->on('document_statuses')->onDelete('restrict')->onUpdate('cascade');
            $table->foreign('document_type_id')->references('id')->on('document_types')->onDelete('restrict')->onUpdate('cascade');

            $table->index('extracted');
        });
        db::statement('ALTER TABLE documents CHANGE document_type_id document_type_id int(10) unsigned NULL AFTER document_status_id');
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
}
