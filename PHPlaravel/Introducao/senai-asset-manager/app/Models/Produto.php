<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Produto extends Model
{
     protected $fillable = ["preco", "validade", "status"];
}
