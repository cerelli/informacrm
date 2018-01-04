<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateLocalitiesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('localities', function (Blueprint $table) {
            $table->increments('id');
            $table->string('country_code',2);
            $table->string('postal_code',20);
            $table->string('place_name',180);
            $table->string('region_name',100);
            $table->string('region_code',20);
            $table->string('province_name',100);
            $table->string('province_code',20);
            $table->double('latitude');
            $table->double('longitude');
            $table->integer('accuracy');

            $table->string('created_by', 60)->default('');
            $table->string('updated_by', 60)->default('');
            $table->softDeletes();
            $table->timestamps();

            $table->index(['postal_code','place_name','province_code']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('localities');
    }
}
