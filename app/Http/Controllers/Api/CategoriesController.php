<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\CategoriesRequest;
use App\Http\Resources\CategoriesResource;
use App\Models\Categories;
use App\Models\Tags;
use App\Repositories\CategoriesRepositoryInterface;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class CategoriesController extends Controller
{
    private $categoriesRepository;

    public function __construct(CategoriesRepositoryInterface $categoriesRepository)
    {
        $this->categoriesRepository = $categoriesRepository;
    }

    public function index(Request $request)
    {
        return CategoriesResource::collection($this->categoriesRepository->all($request));
    }

    public function create()
    {
        //
    }

    public function store(CategoriesRequest $request)
    {
        $request->validated();
        $rank = $this->categoriesRepository->max('rank');

        $create = $this->categoriesRepository->create([
            'name' => $request->post('name'),
            'description' => $request->post('description'),
            'content' => $request->post('content'),
            'parent' => $request->post('parent'),
            'slug' => Str::slug($request->post('slug')),
            'is_active' => 1,
            'rank' => is_null($rank) ? 1 : $rank + 1,
        ]);


        foreach($request->tags as $item){
            Tags::create([
                'tag_type' => Categories::class,
                'tag_id' => $create->id,
                'tag_name' => $item['text'],
                'is_active' => 1,
            ]);
        }

        return response()->json(['result'=> 1 , 'message' => 'İşlem Başarılı'],200);

    }

    public function show($id)
    {
        $categories = $this->categoriesRepository->get($id);

        return new CategoriesResource($categories);

    }

    public function edit(CategoriesRequest $request)
    {
        //
    }

    public function update(CategoriesRequest $request, $id)
    {
        $request->validated();
        $this->categoriesRepository->update($id,[
            'name' => $request->post('name'),
            'description' => $request->post('description'),
            'content' => $request->post('content'),
            'parent' => $request->post('parent'),
            'slug' => Str::slug($request->post('slug')),
            'is_active' => 1,
        ]);

        $tags = Tags::where('tag_id',$id)->where('tag_type',Categories::class);
        $tags->delete();

        foreach($request->tags as $item){
            Tags::create([
                'tag_type' => Categories::class,
                'tag_id' => $id,
                'tag_name' => $item['text'],
                'is_active' => 1,
            ]);
        }

        return response()->json(['result'=> 1 , 'message' => 'İşlem Başarılı'],200);
    }

    public function destroy($id)
    {
        $this->categoriesRepository->delete($id);
        return response()->json(['result'=> 1 , 'message' => 'İşlem Başarılı'],200);
    }
}
