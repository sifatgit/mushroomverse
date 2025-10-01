<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\District;

class AdminDistrictsController extends Controller
{
    public function store(Request $request){

      $validated = $request->validate([

          'district' => 'required|string',
          'division_id' => 'required|integer',

      ]);

        $district = new District;

        $district->name = $request->district;
        $district->division_id = $request->division_id;
        $district->save();

        return back();
    }

    public function delete($id){

        $district = District::find($id);

        $district->delete();

        return back();
    }
}
