<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAddressesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('addresses', function (Blueprint $table) {
            $table->increments('id');

            $table->unsignedInteger('address_type_id')->nullable();

            // $table->string('street', 255);
            $table->string('address')->nullable();
            $table->string('address_line_1');
            $table->string('street_number')->nullable()->default('');
            $table->string('city')->nullable()->default('');
            $table->string('region')->nullable()->default('');
            $table->string('province');
            $table->string('postal_code');
            $table->string('country')->nullable()->default('');
            $table->text('notes')->nullable();

            $table->unsignedInteger('account_id')->nullable();
            // $table->unsignedInteger('locality_id')->nullable();

            $table->string('created_by', 60)->default('');
            $table->string('updated_by', 60)->default('');
            $table->softDeletes();
            $table->timestamps();

            $table->foreign('address_type_id')->references('id')->on('address_types')->onDelete('restrict')->onUpdate('cascade');
            $table->foreign('account_id')->references('id')->on('accounts')->onDelete('cascade')->onUpdate('cascade');
            // $table->foreign('locality_id')->references('id')->on('localities')->onDelete('restrict')->onUpdate('cascade');
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
        Schema::dropIfExists('addresses');
        Schema::enableForeignKeyConstraints();
    }
}
