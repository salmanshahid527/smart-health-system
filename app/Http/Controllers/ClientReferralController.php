<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreClientReferralRequest;
use App\Http\Requests\UpdateClientReferralRequest;
use App\Models\ClientReferral;

class ClientReferralController extends Controller
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
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreClientReferralRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreClientReferralRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\ClientReferral  $clientReferral
     * @return \Illuminate\Http\Response
     */
    public function show(ClientReferral $clientReferral)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\ClientReferral  $clientReferral
     * @return \Illuminate\Http\Response
     */
    public function edit(ClientReferral $clientReferral)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateClientReferralRequest  $request
     * @param  \App\Models\ClientReferral  $clientReferral
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateClientReferralRequest $request, ClientReferral $clientReferral)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\ClientReferral  $clientReferral
     * @return \Illuminate\Http\Response
     */
    public function destroy(ClientReferral $clientReferral)
    {
        //
    }
}
