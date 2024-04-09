<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Shift extends Model
{
    use HasFactory;

    protected $table = "shift";
    
    protected $primaryKey = "id_shift";

    public function getId()
    {
        return $this->attributes['id_shift'];
    } 
    
    public function getShiftName()
    {
        return $this->attributes['nama_shift'];
    } 
    
    public function getStartTime()
    {
        return $this->attributes['jam_masuk'];
    } 

    public function getEndTime()
    {
        return $this->attributes['jam_keluar'];
    } 
    
    public function getNote()
    {
        return $this->attributes['keterangan'];
    } 
    
    // public function getDescription()
    // {
    //     return $this->attributes['description'];
    // } 
    
    // public function setDescription($description)
    // {
    //     $this->attributes['description'] = $description;
    // } 
    
    // public function getImage()
    // {
    //     return $this->attributes['image'];
    // } 
    
    // public function setImage($image)
    // {
    //     $this->attributes['image'] = $image;
    // } 
    
    // public function getPrice()
    // {
    //     return $this->attributes['price'];
    // } 
    
    // public function setPrice($price)
    // {
    //     $this->attributes['price'] = $price;
    // } 
    
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
}
