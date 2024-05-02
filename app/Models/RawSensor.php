<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class RawSensor extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'iot_node_serial_number',
        'dissolver_oxygen',
        'turbidity',
        'salinity',
        'cod',
        'ph',
        'orp',
        'tds',
        'nh4plus',
        'temperature',
        'flow_rate',
        'tss',
        'water_level',
    ];

    /**
     * Get the iot_node that owns the RawSensor
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function iot_node(): BelongsTo
    {
        return $this->belongsTo(IOTNode::class, 'iot_node_serial_number', 'serial_number');
    }
}
