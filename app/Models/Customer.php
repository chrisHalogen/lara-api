<?php

namespace App\Models;

use App\Models\Invoice;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Customer extends Model
{
    use HasFactory;

    protected $fillable = [
        'name', 'type', 'email', 'address', 'city', 'state', 'postal_code'
    ];

    // Notice that I used postal_code and not postalCode.... The database columns is what goes in here not the fields being sent out

    public function invoices()
    {
        return $this->hasMany(Invoice::class);
    }
}
