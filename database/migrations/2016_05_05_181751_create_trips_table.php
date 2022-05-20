<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use App\Models\Country;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('trips', function (Blueprint $table) {
            $table->id();
            $table->string('name', 64);
            $table->string('continent', 64);
            $table->integer('period');
            $table->string('describe',1000);
            $table->double('price');
            $table->foreignIdFor(Country::class)->constrained();
            $table->string('img_name', 150);
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
        Schema::dropIfExists('trips');
        DB::statement('SET FOREIGN_KEY_CHECKS = 1');
    }
};
