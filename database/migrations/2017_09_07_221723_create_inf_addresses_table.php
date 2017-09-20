<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateInfAddressesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('inf_addresses', function (Blueprint $table) {
            $table->increments('id');

            $table->unsignedInteger('inf_address_type_id')->nullable();

            // $table->string('street', 255);
            $table->string('address')->nullable();
            $table->string('address_line_1');
            $table->string('street_number');
            $table->string('city');
            $table->string('region');
            $table->string('province');
            $table->string('postal_code');
            $table->string('country');
            $table->text('notes')->nullable();

            $table->unsignedInteger('inf_account_id')->nullable();
            // $table->unsignedInteger('inf_locality_id')->nullable();

            $table->string('created_by', 60)->default('');
            $table->string('updated_by', 60)->default('');
            $table->softDeletes();
            $table->timestamps();

            $table->foreign('inf_address_type_id')->references('id')->on('inf_address_types')->onDelete('restrict')->onUpdate('cascade');
            $table->foreign('inf_account_id')->references('id')->on('inf_accounts')->onDelete('cascade')->onUpdate('cascade');
            // $table->foreign('inf_locality_id')->references('id')->on('inf_localities')->onDelete('restrict')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::disableForeignKeyConstraints();
        Schema::dropIfExists('inf_addresses');
        Schema::enableForeignKeyConstraints();
    }
}
