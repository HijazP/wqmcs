<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMonitoringTelemetriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('monitoring_telemetries', function (Blueprint $table) {
            $table->id();
            $table->string('iot_node_serial_number')->nullable();
            $table->double('temperature_node',8,2)->default(0);
            $table->double('temperature_edge',8,2)->default(0);
            $table->double('humidity_node',8,2)->default(0);
            $table->double('humidity_edge',8,2)->default(0);
            $table->double('dissolver_oxygen', 8, 2)->default(0);
            $table->double('turbidity', 8, 2)->default(0);
            $table->double('salinity', 8, 2)->default(0);
            $table->double('cod', 8, 2)->default(0);
            $table->double('ph', 8, 2)->default(0);
            $table->double('orp', 8, 2)->default(0);
            $table->double('tds', 8, 2)->default(0);
            $table->double('nitrat', 8, 2)->default(0);
            $table->double('temperature_air', 8, 2)->default(0);
            $table->double('tss', 8, 2)->default(0);
            $table->double('water_level_cm', 8, 2)->default(0);
            $table->double('water_level_persen', 8, 2)->default(0);
            $table->double('debit_air',8,2)->default(0);
            $table->unsignedTinyInteger('status_pompa')->default(0);
            $table->timestamps();

            $table->foreign('iot_node_serial_number')->references('serial_number')->on('i_o_t_nodes')->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('monitoring_telemetries');
    }
}
