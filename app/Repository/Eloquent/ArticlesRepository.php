<?php
namespace App\Repository\Eloquent;

use App\Models\Article;
use App\Repository\Interface\Articlesinterface;
use Elastic\Elasticsearch\Client;
class ArticlesRepository extends EloquentRepository implements Articlesinterface
{

    /**
     * @param Article $article
     * @param Client $elasticsearch
     */

    protected object $model;

   public function __construct(Article $article)
   {
       $this->model= $article;

   }

}
