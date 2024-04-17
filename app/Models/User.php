<?php

namespace App\Models;

use Illuminate\Contracts\Auth\Authenticatable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as AuthenticatableUser;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Notifications\Notifiable;

class User extends AuthenticatableUser implements Authenticatable
{
    protected $table = "user";

    protected $primaryKey = "id_user";

    protected $fillable = [
        'nama_lengkap', 
        'nomor_pegawai',
        'email', 
        'password',
        'departemen',
        'nomor_telepon',
        'role',
    ];

    public static function validate($request)
    {
        $request->validate([
            "nama_lengkap" => "required",
            "nomor_pegawai" => "required",
            "email" => "required",
            "departemen" => "required",
            "nomor_telepon" => "required",
            "role" => "required",
        ]);
    }
    
    public function getId()
    {
        return $this->attributes['id_user'];
    }

    public function setId($id)
    {
        $this->attributes['id_user'] = $id;
    }
    
    public function getName()
    {
        return $this->attributes['nama_lengkap'];
    }

    public function setName($nama_lengkap)
    {
        $this->attributes['nama_lengkap'] = $nama_lengkap;
    }

    public function getEmployeeNumber()
    {
        return $this->attributes['nomor_pegawai'];
    }

    public function setEmployeeNumber($nomor_pegawai)
    {
        $this->attributes['nomor_pegawai'] = $nomor_pegawai;
    }
    
    public function getEmail()
    {
        return $this->attributes['email'];
    }

    public function setEmail($email)
    {
        $this->attributes['email'] = $email;
    }
    
    public function getDepartment()
    {
        return $this->attributes['departemen'];
    }

    public function setDepartment($departemen)
    {
        $this->attributes['departemen'] = $departemen;
    }

    public function getPhoneNumber()
    {
        return $this->attributes['nomor_telepon'];
    }

    public function setPhoneNumber($nomor_telepon)
    {
        $this->attributes['nomor_telepon'] = $nomor_telepon;
    }
    
    public function getRole()
    {
        return $this->attributes['role'];
    }

    public function setRole($role)
    {
        $this->attributes['role'] = $role;
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
