<?php

namespace App\Models;

use App\Models\Concerns\ObservesWrites;
use Illuminate\Database\Eloquent\Model;

class Wish extends Model
{
    use ObservesWrites;
}
