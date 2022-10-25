<?php

namespace App\Models;

use App\Traits\UUID;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
class Progress extends Model
{
    use UUID,HasApiTokens,HasFactory;
}
