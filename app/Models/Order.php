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
