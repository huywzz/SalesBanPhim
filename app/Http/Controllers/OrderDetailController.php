<?php

namespace App\Http\Controllers;

use App\Models\orderDetail;
use App\Http\Requests\StoreOrderDetailRequest;
use App\Http\Requests\UpdateOrderDetailRequest;

class OrderDetailController extends Controller
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
     * @param  \App\Http\Requests\StoreOrderDetailRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreOrderDetailRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\orderDetail  $order_detail
     * @return \Illuminate\Http\Response
     */
    public function show(orderDetail $order_detail)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\orderDetail  $order_detail
     * @return \Illuminate\Http\Response
     */
    public function edit(orderDetail $order_detail)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateOrderDetailRequest  $request
     * @param  \App\Models\orderDetail  $order_detail
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateOrderDetailRequest $request, orderDetail $order_detail)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\orderDetail  $order_detail
     * @return \Illuminate\Http\Response
     */
    public function destroy(orderDetail $order_detail)
    {
        //
    }
}
