<?php

namespace App\Models;

use App\Models\Concerns\ObservesWrites;
use Illuminate\Database\Eloquent\Model;

class Review extends Model
{
    use ObservesWrites;
}
