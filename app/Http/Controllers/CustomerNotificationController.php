<?php

namespace App\Http\Controllers;

use App\Models\CustomerNotification;
use Illuminate\Http\Request;
use App\Utils\CustomerNotificationUtils;

class CustomerNotificationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $customerNotifications = CustomerNotification::all();
        return response()->json($customerNotifications);
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
        $customerNotification = CustomerNotification::create($request->all());
        $response = CustomerNotificationUtils::notify($customerNotification);

        return response()->json(['notification'=>$customerNotification, 'firebase' =>$response]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\CustomerNotification  $customerNotification
     * @return \Illuminate\Http\Response
     */
    public function show(CustomerNotification $customerNotification)
    {
        $customerNotification = CustomerNotification::where('id', $customerNotification);
        return response()->json($customerNotification);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\CustomerNotification  $customerNotification
     * @return \Illuminate\Http\Response
     */
    public function edit(CustomerNotification $customerNotification)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\CustomerNotification  $customerNotification
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, CustomerNotification $customerNotification)
    {
        $customerNotification = CustomerNotification::find($customerNotification);
        if(!empty($customerNotification)){
            $customerNotification->update($request->all());
        }
        return response()->json($customerNotification);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\CustomerNotification  $customerNotification
     * @return \Illuminate\Http\Response
     */
    public function destroy(CustomerNotification $customerNotification)
    {
        $customerNotification = CustomerNotification::find($customerNotification);
        if(!empty($customerNotification)){
            $customerNotification->delete();
        }
        return response()->json(["message"=>"Notification deletted with succès."]);
    }
}
