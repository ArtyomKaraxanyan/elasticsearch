<?php

namespace App\Repository\Eloquent;

use App\Models\Article;
use App\Repository\Interface\Articlesinterface;
use App\Repository\Interface\EloquentInterface;
use Elastic\Elasticsearch\Client;
use Elastic\Elasticsearch\ClientBuilder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Arr;
use InvalidArgumentException;

class EloquentRepository implements EloquentInterface
{
    /**
     * @return mixed
     */
    public function pagination()
    {
        return $this->model::latest()->paginate(15);

    }

    /**
     * @return mixed
     */
    public function all()
    {
    return $this->model::all();
    }

    public function search(string $query = '')
    {

        $items = $this->searchOnElasticsearch($query);

        return $this->buildCollection($items);

    }


    public function searchOnElasticsearch(string $query = ''): array
    {
        $model = new $this->model;

        $client = ClientBuilder::create()
            ->setHosts([config('services.search.hosts')])
            ->build();

        $results = $client->search([
            'size'   => 1000,
            'index' => $model->getSearchIndex(),
            'type' => $model->getSearchType(),
            'body' => [
                'query' => [
                    'multi_match' => [
                        'fields' => ['title^5', 'body', 'tags'],
                        'query' => $query,
                    ],
                ],
            ],
        ]);
        $ids=Arr::pluck($results['hits']['hits'], '_id');
        return $ids;
    }

    /**
     * @param array $ids
     * @return mixed
     */
    public function buildCollection(array $ids):mixed
    {
     return   $this->model::whereIn('id',$ids)->paginate(15);
    }

}
