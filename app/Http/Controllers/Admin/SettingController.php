<?php

namespace App\Http\Controllers\Admin;

use App\Models\Setting;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Core\Services\Admin\SettingService;
use App\Http\Requests\Admin\Setting\SettingStoreRequest;
use App\Http\Requests\Admin\Setting\SettingUpdateRequest;

class SettingController extends Controller
{
    public function __construct(protected SettingService $service) {}

    public function index()
    {
        $settings = $this->service->getAll();
        return view('admin.settings.index', compact('settings'));
    }

    public function show(Setting $setting)
    {
        return view('admin.settings.show', compact('setting'));
    }

    public function create()
    {
        return view('admin.settings.create');
    }

    public function store(SettingStoreRequest $request)
    {
        $this->service->store($request->validated());
        return redirect()->route('admin.settings.index')
            ->with('success', 'Setting created successfully.');
    }

    public function edit()
    {
        $settings = $this->service->getAll();
        return view('admin.settings.edit', compact('settings'));
    }

    public function update(Request $request)
    {
        $inputs = $request->except('_token', '_method');
        $uniqueInputs = array_unique($inputs);

        foreach ($uniqueInputs as $key => $value) {
            $setting = Setting::where('key', $key)->first();
            if ($setting) {
                $setting->update(['value' => $value]);
            }
        }

        return redirect()->route('admin.settings.index')
            ->with('success', 'Settings updated successfully.');
    }

    public function destroy(Setting $setting)
    {
        $this->service->delete($setting->id);
        return redirect()->route('admin.settings.index')
            ->with('success', 'Setting deleted successfully.');
    }
}
