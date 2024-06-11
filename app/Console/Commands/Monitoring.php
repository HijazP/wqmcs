<?php

namespace App\Console\Commands;

use App\Models\IOTNode;
use App\Models\RawSensor;
use Illuminate\Console\Command;
use PhpMqtt\Client\Facades\MQTT;
use App\Models\MonitoringTelemetry;
use App\Events\MonitoringTelemetryEvent;

class Monitoring extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'live:Monitoring';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Monitoring';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
{
    echo "init...";
    $topic_sub = "WQ01";
    $mqtt = MQTT::connection('mosquitto');
    $nodes = IOTNode::query()->pluck('serial_number')->toArray();

    foreach ($nodes as $node) {
        $mqtt->subscribe($topic_sub, function (String $topic, String $message) use ($mqtt, $node) {
            // print('Subscribe ke topic');
            print($message);
            $data = $message;

if (empty($data)) {
    print('Dummy');
    $wqcms = 'DummyWQ';
    $temperature = mt_rand(0, 40);
    $humidity = mt_rand(0, 100);
    $orp = mt_rand(-1000, 1000);
    $do = mt_rand(0, 20);
    $ph = mt_rand(0, 14);
    $air_temperature = mt_rand(0, 40);
    $tds = mt_rand(0, 40);
    $turbidity = mt_rand(0, 40);
    $salinity = mt_rand(0, 40);
    $nitrat = mt_rand(0, 40);
    $tss = mt_rand(0, 40);
    $cod = mt_rand(0, 40);
    $debit_air = mt_rand(0, 200);
    $water_level_cm = mt_rand(0, 200);
    $water_level_persen= mt_rand(0, 100);
    $status_pompa = 'Hidup';
    MonitoringTelemetry::create([
        'iot_node_serial_number' => $node,
        'temperature_node' => $temperature,
        'humidity_node' => $humidity,
        'orp' => $orp,
        'ph' => $ph,
        'dissolver_oxygen' => $do,
        'temperature_air' => $air_temperature,
        'tds' => $tds,
        'turbidity' => $turbidity,
        'salinity' => $salinity,
        'tss' => $tss,
        'nitrat' => $nitrat,
        'cod' => $cod,
        'debit_air' => $debit_air,
        'water_level_cm' => $water_level_cm,
        'water_level_persen' => $water_level_persen,
        'status_pompa' => $status_pompa,

    ]);
} else {
    $pattern = '/^(\w{4}),([-\d.]+),([-\d.]+),([-?\d.]+),([-\d.]+),([-\d.]+),([-\d.]+),([-\d.]+),([-\d.]+),(\w+),#$/';
        if (preg_match($pattern, $data, $matches)) {
        print('Sensor');
        $wqcms = $matches[1];
        $temperature = $matches[2];
        $humidity = $matches[3];
        $orp = $matches[4];
        $do = $matches[5];
        $ph = $matches[6];
        $air_temperature = $matches[7];
        $nitrat = $matches[8];
        // $status_pompa = $matches[9];
        MonitoringTelemetry::create([
            'iot_node_serial_number' => $node,
            'temperature_node' => $temperature,
            'humidity_node' => $humidity,
            'orp' => $orp,
            'ph' => $ph,
            'dissolver_oxygen' => $do,
            'temperature_air' => $air_temperature,
            'nitrat' => $nitrat,
            // 'status_pompa' => $status_pompa,
        ]);
    } else {
        echo "Format data tidak sesuai.";
    }
}
            broadcast(new MonitoringTelemetryEvent($node, $message, ['message' => $message]));

        }, 1);
    }
    print('Dummy');
    $wqcms = 'DummyWQ';
    $temperature = mt_rand(0, 40);
    $humidity = mt_rand(0, 100);
    $orp = mt_rand(-1000, 1000);
    $do = mt_rand(0, 20);
    $ph = mt_rand(0, 14);
    $air_temperature = mt_rand(0, 40);
    $tds = mt_rand(0, 40);
    $turbidity = mt_rand(0, 40);
    $salinity = mt_rand(0, 40);
    $nitrat = mt_rand(0, 40);
    $tss = mt_rand(0, 40);
    $cod = mt_rand(0, 40);
    $debit_air = mt_rand(0, 200);
    $water_level_cm = mt_rand(0, 200);
    $water_level_persen= mt_rand(0, 100);
    $status_pompa = 'Hidup';
    MonitoringTelemetry::create([
        'iot_node_serial_number' => $node,
        'temperature_node' => $temperature,
        'humidity_node' => $humidity,
        'orp' => $orp,
        'ph' => $ph,
        'dissolver_oxygen' => $do,
        'temperature_air' => $air_temperature,
        'tds' => $tds,
        'turbidity' => $turbidity,
        'salinity' => $salinity,
        'tss' => $tss,
        'nitrat' => $nitrat,
        'cod' => $cod,
        'debit_air' => $debit_air,
        'water_level_cm' => $water_level_cm,
        'water_level_persen' => $water_level_persen,
        'status_pompa' => $status_pompa,

    ]);
    $mqtt->loop(true);
}


    }

