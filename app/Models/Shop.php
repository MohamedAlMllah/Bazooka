<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Shop extends Model
{
    use HasFactory;
    public function tables()
    {
        return $this->hasMany(Table::class, 'shop_id');
    }
    public function employments()
    {
        return $this->hasMany(Employment::class, 'shop_id');
    }
    public function employees()
    {
        $employments = $this->employments;
        $employees = collect();
        foreach ($employments as $employment) {
            $employees->push($employment->employee);
        }
        return $employees;
    }
    public function categories()
    {
        return $this->hasMany(Category::class, 'shop_id');
    }
}
