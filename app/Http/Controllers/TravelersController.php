<?php

namespace App\Http\Controllers;

use App\Traveler;
use Illuminate\Http\Request;

class TravelersController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        for ($i = 0; $i < $request->input('len'); $i++){
          $name = str_replace('\' ', '\'', ucwords(str_replace('\'', '\' ', strtolower($request->input("travelers.$i.name")))));
          $emerg = str_replace('\' ', '\'', ucwords(str_replace('\'', '\' ', strtolower($request->input("travelers.$i.emerg")))));
          Traveler::create([
            'name' => $name,
            'gender' => $request->input("travelers.$i.gender"),
            'relationship' => $request->input("travelers.$i.relate"),
            'emerg_name' => $emerg,
            'emerg_phone' => $request->input("travelers.$i.ephn"),
            'user' => $request->input('user')
          ]);
        }
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
     * @param  \App\Traveler  $traveler
     * @return \Illuminate\Http\Response
     */
    public function show(Traveler $traveler)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Traveler  $traveler
     * @return \Illuminate\Http\Response
     */
    public function edit(Traveler $traveler)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Traveler  $traveler
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Traveler $traveler)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Traveler  $traveler
     * @return \Illuminate\Http\Response
     */
    public function destroy(Traveler $traveler)
    {
        //
    }
}
