<?php

namespace App\Model\Inventory\InventoryUsage;

use App\Model\Master\Allocation;
use App\Model\Master\Item;
use App\Model\TransactionModel;

class InventoryUsageItem extends TransactionModel
{
    protected $connection = 'tenant';

    public $timestamps = false;

    protected $casts = [
        'quantity' => 'double',
        'converter' => 'double',
    ];

    protected $fillable = [
        'item_id',
        'quantity',
        'expiry_date',
        'production_number',
        'unit',
        'notes',
        'allocation_id',
    ];

    public function setExpiryDateAttribute($value)
    {
        $this->attributes['expiry_date'] = convert_to_server_timezone($value);
    }

    public function getExpiryDateAttribute($value)
    {
        return convert_to_local_timezone($value);
    }

    public function item()
    {
        return $this->belongsTo(Item::class);
    }

    public function allocation()
    {
        return $this->belongsTo(Allocation::class);
    }
}
