<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class SettingController extends Controller
{
    public function edit()
    {
        // Fetch the row where id is 1
        $data = DB::table('descriptions')->where('id', 1)->first();
        return view('admin.principal.edit', compact('data'));
    }

    public function update(Request $request)
    {
        // Update the description column
        DB::table('descriptions')->where('id', 1)->update([
            'description' => $request->description,
        ]);

        return back()->with('success', 'Message saved successfully!');
    }
}