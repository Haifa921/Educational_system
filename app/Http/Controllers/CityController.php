<?php

namespace App\Http\Controllers;

use App\Models\City;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CityController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $cities = City::withCount('regions')  // Change from 'Region' to 'regions'
            ->latest()
            ->paginate(10);
            
        return view('cities.index', compact('cities'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('cities.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255|unique:city,name',
            'note' => 'nullable|string'
        ]);

        try {
            DB::beginTransaction();
            
            City::create($request->all());
            
            DB::commit();
            
            return redirect()->route('cities.index')
                ->with('success', 'تم إضافة المدينة بنجاح');
                
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()
                ->with('error', 'حدث خطأ أثناء إضافة المدينة: ' . $e->getMessage())
                ->withInput();
        }
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $city = City::with(['Region'])->findOrFail($id);
        return view('cities.show', compact('city'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $city = City::findOrFail($id);
        return view('cities.edit', compact('city'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|string|max:255|unique:city,name,' . $id,
            'note' => 'nullable|string'
        ]);

        try {
            DB::beginTransaction();
            
            $city = City::findOrFail($id);
            $city->update($request->all());
            
            DB::commit();
            
            return redirect()->route('cities.index')
                ->with('success', 'تم تحديث المدينة بنجاح');
                
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()
                ->with('error', 'حدث خطأ أثناء تحديث المدينة: ' . $e->getMessage())
                ->withInput();
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        try {
            DB::beginTransaction();
            
            $city = City::findOrFail($id);
            
            // Check if city has Region
            if ($city->Region()->count() > 0) {
                return redirect()->back()
                    ->with('error', 'لا يمكن حذف المدينة لأنها تحتوي على مناطق');
            }
            
            $city->delete();
            
            DB::commit();
            
            return redirect()->route('cities.index')
                ->with('success', 'تم حذف المدينة بنجاح');
                
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()
                ->with('error', 'حدث خطأ أثناء حذف المدينة: ' . $e->getMessage());
        }
    }
}