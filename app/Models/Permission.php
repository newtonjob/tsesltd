<?php

namespace App\Models;

use App\Models\Concerns\ObservesWrites;
use Illuminate\Database\Eloquent\Model;

class Permission extends Model
{
    use ObservesWrites;
}
