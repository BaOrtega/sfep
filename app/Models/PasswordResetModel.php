<?php namespace App\Models;

use CodeIgniter\Model;

class PasswordResetModel extends Model
{
    protected $table = 'password_resets';
    protected $primaryKey = 'id';
    protected $allowedFields = ['email', 'token', 'expires_at'];
    protected $useTimestamps = false;
    
    // Validar si token es válido
    public function isValidToken($token)
    {
        return $this->where('token', $token)
                    ->where('expires_at >', date('Y-m-d H:i:s'))
                    ->first();
    }
    
    // Eliminar tokens expirados
    public function cleanExpiredTokens()
    {
        return $this->where('expires_at <=', date('Y-m-d H:i:s'))->delete();
    }
}