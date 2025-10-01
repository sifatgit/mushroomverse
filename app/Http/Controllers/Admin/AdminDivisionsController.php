<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Division;

class AdminDivisionsController extends Controller
{
    public function store(Request $request){

      $validated = $request->validate([

          'division' => 'required|string',

      ]);

        $division = new Division;

        $division->name = $request->division;
        $division->save();

        return back();
    }

    public function delete($id){

        $division = Division::find($id);

        foreach($division->districts as $dis){

            $dis->delete();
        }

        $division->delete();

        return back();
    }
}
