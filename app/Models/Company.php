<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Company extends Model
{
    use HasFactory;

    protected $primaryKey = 'id';

    public $incrementing = false;
    
    protected $keyType = 'string';

    protected $fillable = [
        'id',
        'company_name',
        'company_address',
    ];

    public static function validate($request)
    {
        $request->validate([
            "company_name" => "required",
        ]);
    }

    public function getId()
    {
        return $this->attributes['id'];
    } 
    
    public function getCompanyName()
    {
        return $this->attributes['company_name'];
    }

    public function setCompanyName($company_name)
    {
        $this->attributes['company_name'] = $company_name;
    }

    public function getCompanyAddress()
    {
        return $this->attributes['company_address'];
    }

    public function setCompanyAddress($company_address)
    {
        $this->attributes['company_address'] = $company_address;
    }
    
    public function getDescription()
    {
        return $this->attributes['description'];
    }

    public function setDescription($description)
    {
        $this->attributes['description'] = $description;
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

    public function users()
    {
        return $this->hasMany(User::class, 'company_id', 'id');
    }
}
