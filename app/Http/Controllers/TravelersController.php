<?php

namespace App\Http\Controllers;

use App\Traveler;
use Illuminate\Http\Request;

class TravelersController extends Controller
{
    public function store(Request $request)
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
      $this->validate(request(), [
          'name' => 'required',
          'gender' => 'required',
          'relationship' => 'required',
          'emerg_name' => 'required',
          'emerg_phone' => 'required'
      ]);

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
