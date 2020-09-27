<?php

namespace App\Http\Controllers;

use App\Http\Requests\SubscriptionRequest;
use App\Http\Resources\SubscriptionResource;
use App\Repositories\SubscriptionRepository;
use Illuminate\Http\Request;

class SubscriptionController extends Controller
{

    private $subscriptionRepository;

    public function __construct(SubscriptionRepository $subscriptionRepository)
    {
        $this->subscriptionRepository = $subscriptionRepository;
    }

    public function index()
    {
        return SubscriptionResource::collection($this->subscriptionRepository->all());
    }

    public function create()
    {
        //
    }


    public function store(SubscriptionRequest $request)
    {
        $request->validated();

        $create = $this->subscriptionRepository->create([
            'name' => $request->name,
            'email' => $request->email,
            'ip' => $request->getClientIp(),
        ]);

        return response()->json(['result'=> 1 , 'message' => 'İşlem Başarılı'],200);
    }


    public function show($id)
    {
        //
    }


    public function edit($id)
    {
        //
    }


    public function update(SubscriptionRequest $request, $id)
    {
        $request->validated();

        $this->subscriptionRepository->update($id,[
            'name' => $request->name,
            'email' => $request->email,
        ]);

        return response()->json(['result'=> 1 , 'message' => 'İşlem Başarılı'],200);

    }

    public function destroy($id)
    {
        $this->subscriptionRepository->delete($id);
        return response()->json(['result'=> 1 , 'message' => 'İşlem Başarılı'],200);
    }
}
