<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Jadwal extends Model
{
    protected $table = "jadwal";

    public static function validate($request)
    {
        $request->validate([
            "name" => "required|max:255",
            "description" => "required",
            "price" => "required|numeric|gt:0",
            'image' => 'image',
        ]);
    }

    // public static function sumPricesByQuantities($products, $productsInSession)
    // {
    //     $total = 0;
    //     foreach ($products as $product) {
    //         $total = $total + ($product->getPrice()*$productsInSession[$product->getId()]);
    //     }
    //     return $total;
    // }

    public function getId()
    {
        return $this->attributes['id_jadwal'];
    }

    public function setId($id)
    {
        $this->attributes['id_jadwal'] = $id;
    }
    
    public function getUser()
    {
        return $this->attributes['id_user'];
    }

    public function setUser($id_user)
    {
        $this->attributes['id_user'] = $id_user;
    }
    
    public function getShift()
    {
        return $this->attributes['id_shift'];
    }

    public function setShift($id_shift)
    {
        $this->attributes['id_shift'] = $id_shift;
    }
    
    public function getDate()
    {
        $this->attributes['tanggal'];
    }

    public function setDate($tanggal)
    {
        $this->attributes['tanggal'] = $tanggal;
    }

    public function getCreatedAt()
    {
        return $this->attributes['created_at'];
    }

    public function setCreatedAt($createdAt)
    {
        $this->attributes['created_at'] = $createdAt;
    }

    public function getUpdatedAt()
    {
        return $this->attributes['updated_at'];
    }

    public function setUpdatedAt($updatedAt)
    {
        $this->attributes['updated_at'] = $updatedAt;
    }

    // public function items()
    // {
    //     return $this->hasMany(Item::class);
    // }

    // public function getItems()
    // {
    //     return $this->items;
    // }

    // public function setItems($items)
    // {
    //     $this->items = $items;
    // }
}
