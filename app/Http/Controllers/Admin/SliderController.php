<?php

namespace App\Http\Controllers\Admin;

use App\Models\Slider;
use App\Http\Controllers\Controller;
use App\Core\Services\SliderService;
use App\Http\Requests\Admin\Slider\SliderStoreRequest;
use App\Http\Requests\Admin\Slider\SliderUpdateRequest;

class SliderController extends Controller
{
    public function __construct(protected SliderService $service) {}

    public function index()
    {
        $sliders = $this->service->getAll(relations:['media']);
        return view('admin.sliders.index', compact('sliders'));
    }

    public function create()
    {
        return view('admin.sliders.create');
    }

    public function show(Slider $slider)
    {
        return view('admin.sliders.show', compact('slider'));
    }

    public function store(SliderStoreRequest $request)
    {
        $this->service->store($request->validated());
        return redirect()->route('admin.sliders.index')
            ->with('success', 'Slider created successfully.');
    }

    public function edit(Slider $slider)
    {
        return view('admin.sliders.edit', compact('slider'));
    }

    public function update(SliderUpdateRequest $request, Slider $slider)
    {
        $this->service->update($slider->id, $request->validated());
        return redirect()->route('admin.sliders.index')
            ->with('success', 'Slider updated successfully.');
    }

    public function destroy(Slider $slider)
    {
        $this->service->delete($slider->id);

        return redirect()->route('admin.sliders.index')
            ->with('success', 'Slider deleted successfully.');
    }
}
