<?php

namespace App\Http\Controllers;

use App\Models\Article;
use App\Repository\Eloquent\ArticlesRepository;
use App\Repository\Eloquent\EloquentRepository;
use Illuminate\Http\Request;
use Elastic\Elasticsearch\ClientBuilder;
use Illuminate\Support\Facades\Http;
use Illuminate\View\View;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    protected object $search;

    public function __construct(ArticlesRepository $articlesRepository)
    {
//        $this->middleware('auth');

        $this->search= $articlesRepository;
    }

    public function index(Request $request)
    {
        if ($request->ajax()){
            if (!is_null($request->q)){
                $articles = $this->search->search($request->q);
            }else{
                $articles = $this->search->pagination();
            }
            $response['view']=view('partials.articles',['articles'=>$articles])->render();
            $response['paginate']=view('partials.paginate',['articles'=>$articles])->render();
            $response['count']=count($articles);

            return $response;
        }
        $articles = $this->search->pagination();

        return view('welcome',['articles'=>$articles]);
    }


}
