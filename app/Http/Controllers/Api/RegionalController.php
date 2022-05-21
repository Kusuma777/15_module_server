<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Regional;
use Illuminate\Http\Request;

class RegionalController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return response()->json(Regional::all(),200);
    }


    public function store(Request $request)
    {
        $validator = \Validator::make($request->all(),[
            'province' => 'required|string',
            'district' => 'required|string',
        ]);

        if($validator->fails()){
            return response()->json($validator->errors());
        }

        $regional = Regional::create([
            'province' => $request->province,
            'district' => $request->district,
        ]);

        return response()->json(['massage' => 'Regional '.$regional->name.', Berhasil dibuat']);


    }


    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return response()->json(Regional::find($id),200);
    }


    public function update(Request $request, $id)
    {
        $regional = Regional::findOrFail($id);
        $validator = \Validator::make($request->all(),[
            'province' => 'required|string',
            'district' => 'required|string',
        ]);

        if($validator->fails()){
            return response()->json($validator->errors());
        }

        $regional->province = $request->province;
        $regional->district = $request->district;

        $regional->save();
        return response()
            ->json(['massage' => 'Hi'.$regional->name.', Berhasil di update']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $regional = Regional::findOrFail($id);
        $regional->delete();

        return response()
            ->json(['massage' => 'Hi '.$regional->name.', Berhasil dihapus']);
    }
}
