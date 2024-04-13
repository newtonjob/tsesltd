<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Gate;
use Illuminate\View\View;

class SettingController
{
    public function edit(): View
    {
        Gate::authorize('manage-site-settings');

        return view('settings.edit');
    }
}
