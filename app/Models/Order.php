<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;
    protected $fillable = ['prenom', 'nom', 'phone','department_id', 'payment_id'];

    public function Payment()
    {
        return $this->belongsTo(Payment::class, 'payment_id', 'id' );
    }
    public function Department()
    {
        return $this->belongsTo(Department::class, 'department_id', 'id' );
    }
}
