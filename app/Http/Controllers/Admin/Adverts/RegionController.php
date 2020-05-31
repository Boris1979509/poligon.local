<?php

namespace App\Http\Controllers\Admin\Adverts;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Adverts\Regions\RegionCreateRequest;
use App\Http\Requests\Admin\Adverts\Regions\RegionUpdateRequest;
use App\Models\Adverts\Region;
use Exception;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Str;
use Illuminate\View\View;

class RegionController extends Controller
{
    /**
     * @return View
     */
    public function index(): View
    {
        $regions = Region::where('parent_id', null)->orderBy('name')->get();
        return view('admin.adverts.regions.index', compact('regions'));
    }

    /**
     * @param Request $request
     * @return View
     */
    public function create(Request $request): View
    {
        $parent = null;
        if ($parent = $request->parent) {
            $parent = Region::findOrFail($request->parent);
        }
        return view('admin.adverts.regions.create', compact('parent'));
    }

    /**
     * @param RegionCreateRequest $request
     * @return RedirectResponse
     */
    public function store(RegionCreateRequest $request): RedirectResponse
    {
        $data = [
            'name'      => $name = $request['name'],
            'slug'      => Str::slug($name),
            'parent_id' => $request['parent'],
        ];
        $region = Region::create($data);

        return redirect()->route('admin.adverts.regions.show', $region);
    }

    /**
     * @param Region $region
     * @return View
     */
    public function show(Region $region): view
    {
        $regions = $region->children()->orderBy('name')->get();
        return view('admin.adverts.regions.show', compact('regions', 'region'));
    }

    /**
     * @param Region $region
     * @return View
     */
    public function edit(Region $region): view
    {
        return view('admin.adverts.regions.edit', compact('region'));
    }

    /**
     * @param RegionUpdateRequest $request
     * @param Region $region
     * @return RedirectResponse
     */
    public function update(RegionUpdateRequest $request, Region $region): RedirectResponse
    {
        $region->update([
            'name' => $name = $request['name'],
            'slug' => Str::slug($name),
        ]);

        return redirect()->route('admin.adverts.regions.show', $region);
    }

    /**
     * @param Region $region
     * @return RedirectResponse
     * @throws Exception
     */
    public function destroy(Region $region): RedirectResponse
    {
        $region->delete();

        return redirect()->route('admin.adverts.regions.index');
    }
}
