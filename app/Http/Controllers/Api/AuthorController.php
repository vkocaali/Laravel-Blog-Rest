<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\AuthorRequest;
use App\Http\Resources\AuthorResource;
use App\Repositories\AuthorRepositoryInterface;

class AuthorController extends Controller
{

    private $authorRepository;

    public function __construct(AuthorRepositoryInterface $authorRepository)
    {
        $this->authorRepository = $authorRepository;
    }

    public function index()
    {
        return AuthorResource::collection($this->authorRepository->all());
    }


    public function create()
    {
        //
    }


    public function store(AuthorRequest $request)
    {
        $request->validated();

        $create = $this->authorRepository->create([
            'author_name' => $request->post('author_name'),
            'author_description' => $request->post('author_description'),
            'is_active' => 1,
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

    public function update(AuthorRequest $request, $id)
    {
        $request->validated();

        $this->authorRepository->update($id,[
            'author_name' => $request->post('author_name'),
            'author_description' => $request->post('author_description'),
            'is_active' => 1,
        ]);

        return response()->json(['result'=> 1 , 'message' => 'İşlem Başarılı'],200);
    }


    public function destroy($id)
    {
        $this->authorRepository->delete($id);
        return response()->json(['result'=> 1 , 'message' => 'İşlem Başarılı'],200);
    }
}
