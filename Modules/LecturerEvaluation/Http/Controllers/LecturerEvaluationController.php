<?php

namespace Modules\LecturerEvaluation\Http\Controllers;

use App\Models\Lecturer;
use App\Models\Unit;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;

class LecturerEvaluationController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return Renderable
     */

    public function index()
    {
        $unit = Unit::all();

        $lecturer = Lecturer::all();



//        $unitLecturer = Lecturer::where('unit_id', '=', $unit->id);
//
//        return $unitLecturer;

//        $lecturer = $this->unit->id;
//
////        $lecturer = Lecturer::where('unit_id', '=', 2)->get();
//
////        return $unit;
//        return $lecturer->unit->unitName;

        return view('lecturerevaluation::index')->with('units', $unit);
    }

    /**
     * Show the form for creating a new resource.
     * @return Renderable
     */
    public function create()
    {
        return view('lecturerevaluation::create');
    }

    /**
     * Store a newly created resource in storage.
     * @param Request $request
     * @return Renderable
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Show the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function show($id)
    {
        return view('lecturerevaluation::show');
    }

    /**
     * Show the form for editing the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function edit($id)
    {
        return view('lecturerevaluation::edit');
    }

    /**
     * Update the specified resource in storage.
     * @param Request $request
     * @param int $id
     * @return Renderable
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     * @param int $id
     * @return Renderable
     */
    public function destroy($id)
    {
        //
    }
}
