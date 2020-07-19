<?php

namespace App\Http\Controllers;

use App\PersonalityList;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class PersonalityListController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return JsonResponse
     */
    public function index()
    {
        $model = new PersonalityList();
        $list = $model
            ->newQuery()
            ->where('version_id', 8)
            ->select($model->camelColumnNameList())
            ->get();

        return response()->json($list);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\PersonalityList  $personalityList
     * @return \Illuminate\Http\Response
     */
    public function show(PersonalityList $personalityList)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\PersonalityList  $personalityList
     * @return \Illuminate\Http\Response
     */
    public function edit(PersonalityList $personalityList)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\PersonalityList  $personalityList
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, PersonalityList $personalityList)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\PersonalityList  $personalityList
     * @return \Illuminate\Http\Response
     */
    public function destroy(PersonalityList $personalityList)
    {
        //
    }
}
