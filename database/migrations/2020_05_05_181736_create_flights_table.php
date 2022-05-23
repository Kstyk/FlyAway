<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use App\Models\Trip;
use App\Models\Airport;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('flights', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(Trip::class)->constrained();
            $table->string('airline_name', 128);
            $table->integer('places');
            $table->bigInteger('departure_airport')->unsigned();
            $table->bigInteger('destination_airport')->unsigned();
            $table->foreign('departure_airport')->references('id')->on('airports')->onDelete('restrict');
            $table->foreign('destination_airport')->references('id')->on('airports')->onDelete('restrict');
            $table->date('departure_date');
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
        DB::statement('SET FOREIGN_KEY_CHECKS = 0');
        Schema::dropIfExists('flights');
        DB::statement('SET FOREIGN_KEY_CHECKS = 1');
    }
};
