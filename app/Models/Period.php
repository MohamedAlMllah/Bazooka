<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Period extends Model
{
    use HasFactory;

    protected $dates = ['end_at'];

    public function order()
    {
        return $this->belongsTo(Order::class);
    }
    public function price()
    {
        $timeDifference = $this->created_at->diff($this->end_at);
        if ($timeDifference->format("%S") >= 30)
            $timeDifferenceMinutes = $timeDifference->format("%I") + 1;
        else
            $timeDifferenceMinutes = $timeDifference->format("%I");

        if ($this->type == 'single') {
            $price = $timeDifference->format("%H") * $this->order->table->single_price;
            $price += $timeDifferenceMinutes * $this->order->table->single_price / 60;
        } else {
            $price = $timeDifference->format("%H") * $this->order->table->multiplayer_price;
            $price += $timeDifferenceMinutes * $this->order->table->multiplayer_price / 60;
        }
        return round($price, 2);
    }
}
