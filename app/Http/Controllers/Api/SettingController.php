<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\UpdateSettingRequest;
use App\Models\Setting;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Cache;

class SettingController extends Controller
{
    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateSettingRequest $request)
    {
        $this->authorize('manage-site-settings');

        site()->update($request->validated());

        Cache::forget('setting');

        return Response::api('Settings saved successfully');
    }
}
