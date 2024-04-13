<?php

namespace App\Observers;

use App\Models\Location;
use Illuminate\Support\Str;
use Illuminate\Validation\ValidationException;

class LocationObserver
{
    public function creating(Location $location): void
    {
        $location->slug       = Str::slug($location->name);
        $location->created_by = user('id');
    }

    public function updating(Location $location): void
    {
        $location->slug       = Str::slug($location->name);
        $location->updated_by = user('id');
    }

    public function deleting(Location $location)
    {
        $location->products()->detach();
    }
}

