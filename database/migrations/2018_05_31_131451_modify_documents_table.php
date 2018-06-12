<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

class ModifyDocumentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        $columns = [];
        //check whether documents table has path column
        if (Schema::hasColumn('documents', 'path')); { array_push($columns, 'path'); }
        if (Schema::hasColumn('documents', 'preview')); { array_push($columns, 'preview'); }
        if (Schema::hasColumn('documents', 'type')); { array_push($columns, 'type'); }
        if (Schema::hasColumn('documents', 'disk')); { array_push($columns, 'disk'); }
        if (Schema::hasColumn('documents', 'hash')); { array_push($columns, 'hash'); }
        if (Schema::hasColumn('documents', 'size')); { array_push($columns, 'size'); }
        if (Schema::hasColumn('documents', 'width')); { array_push($columns, 'width'); }
        if (Schema::hasColumn('documents', 'height')); { array_push($columns, 'height'); }
        if (Schema::hasColumn('documents', 'created_by')); { array_push($columns, 'created_by'); }
        if (Schema::hasColumn('documents', 'updated_by')); { array_push($columns, 'updated_by'); }

        if (count($columns)) {
            Schema::table('documents', function (Blueprint $table) use ($columns) {
                $table->dropColumn($columns);
            });
        }

        if (Schema::hasColumn('documents', 'inf_account_id'));
        {
            Schema::table('documents', function($table) {
                $table->renameColumn('inf_account_id', 'account_id');
            });
        }
        if (Schema::hasColumn('documents', 'inf_document_status_id'));
        {
            Schema::table('documents', function($table) {
                $table->renameColumn('inf_document_status_id', 'document_status_id');
            });
        }

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
