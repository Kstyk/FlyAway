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
            $table->string('nazwa_linii', 128);
            $table->foreignIdFor(Airport::class)->constrained();
            $table->foreignIdFor(Airport::class, 'airport_id_2')->constrained();
            $table->date('data_wylotu');
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
