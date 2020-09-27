<?php

namespace App\Http\Controllers\Api;

use App\Events\NewArticleNoficationEvent;
use App\Http\Controllers\Controller;
use App\Http\Requests\ArticleRequest;
use App\Http\Resources\ArticleResource;
use App\Models\Article;
use App\Models\Tags;
use App\Repositories\ArticlesRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class ArticleController extends Controller
{
    private $articleRepository;

    public function __construct(ArticlesRepository $articleRepository)
    {
        $this->articleRepository = $articleRepository;
    }

    public function index()
    {
        return ArticleResource::collection($this->articleRepository->all());
    }

    public function create()
    {
        //
    }


    public function store(ArticleRequest $request)
    {
        $request->validated();
        $rank = $this->articleRepository->max('rank');

        $create = $this->articleRepository->create([
            'title' => $request->post('title'),
            'content' => $request->post('content'),
            'slug' => Str::slug($request->post('slug')),
            'categories_id' => $request->post('categories_id'),
            'author_id' => $request->post('author_id'),
            'is_active' => 1,
            'rank' => is_null($rank) ? 1 : $rank +1,
        ]);

        foreach ($request->tags as $item){
            Tags::create([
                'tag_type' => Article::class,
                'tag_id' => $create->id,
                'tag_name' => $item,
                'is_active' => 1,
            ]);
        }

        event(new NewArticleNoficationEvent($create));

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

    public function update(ArticleRequest $request, $id)
    {
        $request->validated();

        $this->articleRepository->update($id,[
            'title' => $request->post('title'),
            'content' => $request->post('content'),
            'slug' => Str::slug($request->post('slug')),
            'categories_id' => $request->post('categories_id'),
            'author_id' => $request->post('author_id'),
            'is_active' => 1,
        ]);

        $tags = Tags::where('tag_id',$id)->where('tag_type',Article::class);
        $tags->delete();

        foreach ($request->tags as $item){
            Tags::create([
               'tag_type' => Article::class,
               'tag_id' => $id,
               'tag_name' => $item,
               'is_active' => 1,
            ]);
        }

        return response()->json(['result'=> 1 , 'message' => 'İşlem Başarılı'],200);

    }

    public function destroy($id)
    {
        $this->articleRepository->delete($id);
        return response()->json(['result'=> 1 , 'message' => 'İşlem Başarılı'],200);
    }
}
