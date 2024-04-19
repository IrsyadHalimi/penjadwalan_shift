<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Departemen extends Model
{
    use HasFactory;

    protected $table = "departemen";
    
    protected $primaryKey = "id_departemen";

    public static function validate($request)
    {
        $request->validate([
            "nama_departemen" => "required",
        ]);
    }

    public function getId()
    {
        return $this->attributes['id_departemen'];
    } 
    
    public function getDepartemenName()
    {
        return $this->attributes['nama_departemen'];
    }

    public function setDepartemenName($departemenName)
    {
        $this->attributes['nama_departemen'] = $departemenName;
    }

    public function getNote()
    {
        return $this->attributes['keterangan'];
    } 

    public function setNote($note)
    {
        $this->attributes['keterangan'] = $note;
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
}
