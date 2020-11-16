<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Settings;
use Illuminate\Http\Request;

class SettingsController extends Controller
{

    public function index()
    {
        $settings = Settings::find(1)->first();
        return response()->json($settings,200);
    }


    public function create()
    {
        //
    }


    public function store(Request $request)
    {
        //
    }


    public function show($id)
    {
        //
    }


    public function edit($id)
    {
        //
    }


    public function update(Request $request, $id)
    {
        $settings = Settings::find($id)->first();
        $data = $settings;
        $settings->update([
            $request->post('variable') => $request->post('variableValue'),
        ]);

        return response()->json($data,200);
    }


    public function destroy($id)
    {
        //
    }
}
