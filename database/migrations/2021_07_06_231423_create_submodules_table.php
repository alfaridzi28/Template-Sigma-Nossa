<?php

use App\Submodule;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSubmodulesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('submodules', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('subtitle');
            $table->longText('url');
            $table->string('slug');
            $table->integer('module_id');
            $table->timestamps();
        });

        Submodule::create([
            'subtitle' => 'SQM Predictive Logic',
            'module_id' => 1,
            'url' => 'https://kibanasqm.telkom.co.id/app/dashboards#/view/7fa412e0-7564-11ea-8bf0-a1a8993dba7a?embed=true&_g=(filters%3A!()%2CrefreshInterval%3A(pause%3A!t%2Cvalue%3A0)%2Ctime%3A(from%3Anow-2d%2Cto%3Anow))&show-query-input=true&show-time-filter=true',
            'slug' => 'sqm-predictive-logic',
        ]); 

        Submodule::create([
            'subtitle' => 'SQM Predictive Physic',
            'module_id' => 1,
            'url' => 'https://kibanasqm.telkom.co.id/s/dash-sqm-internet-physical-quality/app/dashboards#/view/865f6ab0-4c7b-11ea-b476-030a06252020?embed=true&_g=(filters%3A!()%2CrefreshInterval%3A(pause%3A!t%2Cvalue%3A0)%2Ctime%3A(from%3Anow-2d%2Cto%3Anow))&show-query-input=true&show-time-filter=true',
            'slug' => 'sqm-predictive-physic',
        ]);

        Submodule::create([
            'subtitle' => 'SQM RCA Internet Lambat',
            'module_id' => 2,
            'url' => 'https://kibanasqm.telkom.co.id/s/root-cause/app/canvas#/workpad/workpad-6ef5ae87-8bd8-4e86-b4dd-31fc8825c71e/page/1?__refreshInterval=30s&__fullscreen=true',
            'slug' => 'rca-internet-lambat',
        ]); 

        Submodule::create([
            'subtitle' => 'SQM Predictive Metro Down',
            'module_id' => 3,
            'url' => 'https://kibanasqm.telkom.co.id/s/port-metro-down/goto/0bc53367b12b4a16b94b0b1ae4914fe1',
            'slug' => 'sqm-predictive-metro-down',
        ]); 

        /* metro down https://kibanasqm.telkom.co.id/s/port-metro-down/goto/0bc53367b12b4a16b94b0b1ae4914fe1 */
        /* logic https://kibanasqm.telkom.co.id/app/dashboards#/view/7fa412e0-7564-11ea-8bf0-a1a8993dba7a?embed=true&_g=(filters%3A!()%2CrefreshInterval%3A(pause%3A!t%2Cvalue%3A0)%2Ctime%3A(from%3Anow-2d%2Cto%3Anow))&show-query-input=true&show-time-filter=true */
        /* physic https://kibanasqm.telkom.co.id/s/dash-sqm-internet-physical-quality/app/dashboards#/view/865f6ab0-4c7b-11ea-b476-030a06252020?embed=true&_g=(filters%3A!()%2CrefreshInterval%3A(pause%3A!t%2Cvalue%3A0)%2Ctime%3A(from%3Anow-2d%2Cto%3Anow))&show-query-input=true&show-time-filter=true */
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('submodules');
    }
}
