<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateChecksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('checks', function (Blueprint $table) {
            $table->Increments('id');
            //ルートのコード
            $table->string('route_code',191)->nullable(false);
            //緯度経度
            $table->double('latitude',9,7)->nullable(false);
            $table->double('longitude',10,7)->nullable(false);
            //pointナンバー
            $table->integer('point_no')->nullable(false);
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
        Schema::dropIfExists('checks');
    }
}
