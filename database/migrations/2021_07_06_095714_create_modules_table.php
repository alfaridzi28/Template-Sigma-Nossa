<?php

use App\Module;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateModulesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('modules', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('title');
            $table->timestamps();
        });

        Module::create([
            'id' => 1,
            'title' => 'SQM Predictive Internet'
        ]);

        Module::create([
            'id' => 2,
            'title' => 'SQM RCA'
        ]);

        Module::create([
            'id' => 3,
            'title' => 'SQM Metro Down'
        ]);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('modules');
    }
}
