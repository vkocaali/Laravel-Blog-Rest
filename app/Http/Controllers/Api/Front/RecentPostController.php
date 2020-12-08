<?php

namespace App\Http\Controllers\Api\Front;

use App\Http\Controllers\Controller;
use App\Http\Resources\ArticleResource;
use App\Repositories\ArticlesRepository;
use Illuminate\Http\Request;

class RecentPostController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */

    private $articleRepository;

    public function __construct(ArticlesRepository $articleRepository)
    {
        $this->articleRepository = $articleRepository;
    }

    public function __invoke(Request $request)
    {
        return ArticleResource::collection($this->articleRepository->orderBy('created_at','DESC','3'));
    }
}
