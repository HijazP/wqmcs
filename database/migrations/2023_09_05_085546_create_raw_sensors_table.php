<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRawSensorsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('raw_sensors', function (Blueprint $table) {
            $table->id();
            $table->string('iot_node_serial_number')->nullable();
            $table->foreign('iot_node_serial_number')->references('serial_number')->on('i_o_t_nodes')->nullOnDelete();
            $table->double('dissolver_oxygen', 8, 2);
            $table->double('turbidity', 8, 2);
            $table->double('salinity', 8, 2);
            $table->double('cod', 8, 2);
            $table->double('ph', 8, 2);
            $table->double('orp', 8, 2);
            $table->double('tds', 8, 2);
            $table->double('nitrat', 8, 2);
            $table->double('temperature_air', 8, 2);
            $table->double('debit_air', 8, 2);
            $table->double('tss', 8, 2);
            $table->double('water_level_cm', 8, 2);
            $table->double('water_level_persen', 8, 2);
            $table->unsignedTinyInteger('status_pompa')->default(0);
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
        Schema::dropIfExists('raw_sensors');
    }
}
