<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CustomerNotification extends Model
{
    use HasFactory;

    protected $fillable = [
        "customer_id",
        "title",
        "body",
        "type",
        "is_read",
        "is_received",
        "meta_data_id",
        "meta_data",
    ];
}
