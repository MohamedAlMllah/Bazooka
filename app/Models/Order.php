<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $table = 'orders';
    use HasFactory;
    public function table()
    {
        return $this->belongsTo(Table::class);
    }
    public function orderItems()
    {
        return $this->hasMany(OrderItem::class);
    }
    public function notSentItems()
    {
        return $this->orderItems->where('is_sent', false);
    }
    public function sendOrderItems()
    {
        $orderItems = $this->orderItems;
        foreach ($orderItems->where('is_sent', false) as $orderItem) {
            $previousOrderItem = $orderItems->where('item_id', $orderItem->item_id)->where('is_sent', true)->first();
            if ($previousOrderItem) {
                $previousOrderItem->quantity += $orderItem->quantity;
                $previousOrderItem->save();
                $orderItem->delete();
            } else {
                $orderItem->is_sent = true;
                $orderItem->save();
            }
        }
    }
    public function totalCashForItems()
    {
        $orderItems = $this->orderItems;
        $totalCash = 0;
        foreach ($orderItems as $orderItem) {
            $totalCash += $orderItem->item->price * $orderItem->quantity;
        }
        return $totalCash;
    }
    public function periods()
    {
        return $this->hasMany(Period::class);
    }
    public function currentPeriod()
    {
        return $this->periods->where('end_at', null)->first();
    }
    public function finishedPeriods()
    {
        return $this->periods->where('end_at', '!=', null);
    }
    public function totalCashForPeriods()
    {
        $periods = $this->finishedPeriods();
        $totalCash = 0;
        foreach ($periods as $period) {
            $totalCash += $period->price();
        }
        return $totalCash;
    }
    public function totalCash()
    {
        return $this->totalCashForItems() + $this->totalCashForPeriods();
    }
}
