<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateOpportunitiesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('opportunities', function (Blueprint $table) {
            $table->increments('id');
            $table->text('description')->nullable();
            $table->decimal('value', 13, 2);
            $table->datetime('expiration_date')->nullable();

            $table->unsignedInteger('account_id')->nullable();
            $table->unsignedInteger('opportunity_status_id')->nullable();
            $table->unsignedInteger('opportunity_result_id')->nullable();

            $table->string('result_description',255)->default('');

            $table->string('created_by', 60)->default('');
            $table->string('updated_by', 60)->default('');
            $table->softDeletes();
            $table->timestamps();

            $table->foreign('account_id')->references('id')->on('accounts')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('opportunity_status_id')->references('id')->on('opportunity_statuses')->onDelete('restrict')->onUpdate('cascade');
            $table->foreign('opportunity_result_id')->references('id')->on('opportunity_results')->onDelete('restrict')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('opportunities');
    }
}
