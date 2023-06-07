<?php

namespace App\project\MoneyRequests\controllers;

use App\Models\money_request;
use App\project\MoneyRequests\Requests\moneyReqRequest;
use App\project\Profile\Services\ProfileService;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class RequestsController
{
    private profileService $profileService;
    public function __construct(profileService $profileService) {

        $this->profileService = $profileService;
    }


    public function showall(){
    $moneyRequests = money_request::with('user')->get();

    return response()->json(['data'=>$moneyRequests],200);

    }

    public function showallPending(){
        $moneyRequests = money_request::with('user')
            ->where('state', 'pending')
            ->get();

        return response()->json(['data'=>$moneyRequests],200);

    }


    public function show($id){
        $request=money_request::find($id);
        return response()->json(['data'=>$request],200);
    }



    public function store(moneyReqRequest $request){
        $moneyRequest=new money_request();
        $moneyRequest->user_id = Auth::id();
        $moneyRequest->balance = $request->balance;
        $moneyRequest->save();
        return response()->json(['status'=>'sent succfully'],200);

    }


    public function acceptRequest($requestId,$userId)
    {
        try {
            DB::beginTransaction();

            $moneyRequest = money_request::find($requestId);
            $requestValue = $moneyRequest->balance;

            if ($this->profileService->updateBalance($requestValue,$userId))
            {
                $moneyRequest->state = "accepted";
                $moneyRequest->save();

                DB::commit();

                return response()->json(['status' => 'updated successfully'], 200);
            }
            else
            {
                return response()->json(['status' => 'error happened'], 200);
            }
        } catch (\Exception $e) {
            DB::rollBack();

            // handle the exception here
            return response()->json(['status' => 'Error: ' . $e->getMessage()], 500);
        }
    }

    public function destroy($id){
        $moneyRequest = money_request::find($id);
        if($moneyRequest===null){
            return response()->json(['status'=>'not_found'],400);
        }
        $moneyRequest->delete();

        return response()->json(['status'=>'success'],200);
    }







}
