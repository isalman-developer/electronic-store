<?php

namespace App\Http\Controllers\Admin;

use App\Models\Brand;
use App\Http\Controllers\Controller;
use App\Core\Services\Admin\BrandService;
use App\Http\Requests\Admin\Brand\BrandStoreRequest;
use App\Http\Requests\Admin\Brand\BrandUpdateRequest;

class BrandController extends Controller
{
    public function __construct(protected BrandService $service) {}
    public function index()
    {
        $brands = $this->service->getAll(relations: ['media']);
        return view('admin.brands.index', compact('brands'));
    }

    public function create()
    {
        return view('admin.brands.create');
    }

    public function show(Brand $brand)
    {
        $brands = $this->service->getAll(relations: ['media']);
        return view('admin.brands.index', compact('brands'));
    }

    public function store(BrandStoreRequest $request)
    {
        $this->service->store($request->validated());
        return redirect()->route('admin.brands.index')
            ->with('success', 'Brand created successfully.');
    }

    public function edit(Brand $brand)
    {
        return view('admin.brands.edit', compact('brand'));
    }

    public function update(BrandUpdateRequest $request, Brand $brand)
    {
        $this->service->update($brand->id, $request->validated());
        return redirect()->route('admin.brands.index')
            ->with('success', 'Brand updated successfully.');
    }

    public function destroy(Brand $brand)
    {
        // Check if brand has products
        if ($brand->products()->exists()) {
            return redirect()->route('admin.brands.index')
                ->with('error', 'Cannot delete brand with associated products.');
        }

        $this->service->delete($brand->id);

        return redirect()->route('admin.brands.index')
            ->with('success', 'Brand deleted successfully.');
    }
}
