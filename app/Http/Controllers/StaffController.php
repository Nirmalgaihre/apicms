<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class StaffController extends Controller
{
    // 1. Manage List (Admin Dashboard)
    public function index() {
        $staff = DB::table('staff')
            ->leftJoin('staff_categories', 'staff.staff_category', '=', 'staff_categories.id')
            ->select(
                'staff.*', 
                'staff_categories.title as category_title',
                'staff_categories.position as cat_pos'
            )
            // Sort by category position numerically first
            ->orderByRaw('CAST(cat_pos AS UNSIGNED) ASC') 
            // Then sort by staff member's position numerically (1, 2, 3... 10, 11)
            ->orderByRaw('CAST(staff.position AS UNSIGNED) ASC') 
            ->get();
                
        return view('admin.staff.index', compact('staff'));
    }

    // 2. Add Form
    public function create() {
        $categories = DB::table('staff_categories')->get();
        return view('admin.staff.create', compact('categories'));
    }

    // 3. Store Staff
    public function store(Request $request) {
        $data = $request->only('staff_name', 'staff_phone', 'staff_email', 'staff_category');
        
        // FIX: Treat position as a number using CAST to get the true maximum value
        $maxPos = DB::table('staff')->max(DB::raw('CAST(position AS UNSIGNED)'));
        $data['position'] = $maxPos ? $maxPos + 1 : 1;

        if ($request->hasFile('staff_img')) {
            $data['staff_img'] = $request->file('staff_img')->store('staff', 'public');
        }

        DB::table('staff')->insert(array_merge($data, [
            'created_at' => now(),
            'updated_at' => now()
        ]));
        
        return redirect()->route('staff.index')->with('success', 'Staff added successfully!');
    }

    // 4. Edit Form
    public function edit($id) {
        $staff = DB::table('staff')->where('id', $id)->first();
        $categories = DB::table('staff_categories')->get();
        return view('admin.staff.edit', compact('staff', 'categories'));
    }

    // 5. Update
    public function update(Request $request, $id) {
        $data = $request->only('staff_name', 'staff_phone', 'staff_email', 'staff_category');

        if ($request->hasFile('staff_img')) {
            $old = DB::table('staff')->where('id', $id)->first();
            if($old && $old->staff_img) Storage::disk('public')->delete($old->staff_img);
            $data['staff_img'] = $request->file('staff_img')->store('staff', 'public');
        }

        DB::table('staff')->where('id', $id)->update(array_merge($data, ['updated_at' => now()]));
        return redirect()->route('staff.index')->with('success', 'Staff updated!');
    }

    // 6. Delete
    public function destroy($id) {
        $staff = DB::table('staff')->where('id', $id)->first();
        if($staff && $staff->staff_img) Storage::disk('public')->delete($staff->staff_img);
        DB::table('staff')->where('id', $id)->delete();
        return back()->with('success', 'Staff deleted.');
    }

    // 7. Hierarchy View
    public function hierarchy() {
        $staff = DB::table('staff')
            ->leftJoin('staff_categories', 'staff.staff_category', '=', 'staff_categories.id')
            ->select('staff.*', 'staff_categories.title as category_title')
            ->orderByRaw('CAST(staff.position AS UNSIGNED) ASC') // Keeps it numeric in drag-drop screen
            ->get();
            
        return view('admin.staff.hierarchy', compact('staff'));
    }

    // 8. Reorder Logic (AJAX)
    public function reorder(Request $request) {
        if($request->has('order')) {
            foreach ($request->order as $index => $id) {
                DB::table('staff')
                    ->where('id', $id)
                    ->update(['position' => $index + 1]);
            }
            return response()->json(['status' => 'success']);
        }
        return response()->json(['status' => 'error'], 400);
    }

    // 9. Public Frontend View
    public function publicIndex() {
    $staff = DB::table('staff')
        ->leftJoin('staff_categories', 'staff.staff_category', '=', 'staff_categories.id')
        ->select(
            'staff.*', 
            'staff_categories.title as category_title',
            'staff_categories.position as cat_pos'
        )
        ->orderByRaw('CAST(cat_pos AS UNSIGNED) ASC') 
        ->orderByRaw('CAST(staff.position AS UNSIGNED) ASC') 
        ->get();

        $staffGroups = $staff->groupBy('category_title');

        return view('staff.index', compact('staffGroups'));
    }

    // 10. Principal Message View
    public function principalMessage() {
        $principal = DB::table('staff')
            ->leftJoin('staff_categories', 'staff.staff_category', '=', 'staff_categories.id')
            ->where('staff_categories.title', 'Principal')
            ->select('staff.*')
            ->first();

        $message = DB::table('descriptions')->first();

        return view('about.principal', compact('principal', 'message'));
    }
}