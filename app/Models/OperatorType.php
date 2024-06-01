<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OperatorType extends Model
{
    use HasFactory;

    public static function validate($request)
    {
        $request->validate([
            "operator_name_type" => "required",
        ]);
    }

    public function getId()
    {
        return $this->attributes['id'];
    } 
    
    public function getOperatorNameType()
    {
        return $this->attributes['operator_name_type'];
    }

    public function setOperatorNameType($operator_name_type)
    {
        $this->attributes['operator_name_type'] = $operator_name_type;
    }

    public function getDepartmentId()
    {
        return $this->attributes['department_id'];
    }

    public function setDepartmentId($department_id)
    {
        $this->attributes['department_id'] = $department_id;
    }
    
    public function getNotes()
    {
        return $this->attributes['notes'];
    }

    public function setNotes($notes)
    {
        $this->attributes['notes'] = $notes;
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
        return $this->hasMany(User::class);
    }
}
