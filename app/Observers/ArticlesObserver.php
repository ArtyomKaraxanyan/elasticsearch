<?php

namespace App\Observers;

use App\Models\Article;
use Elastic\Elasticsearch\Client;
use Elastic\Elasticsearch\ClientBuilder;
use Illuminate\Http\Request;

class ArticlesObserver
{
    /**
     * @param Article $article
     * @return void
     * @throws \Elastic\Elasticsearch\Exception\AuthenticationException
     * @throws \Elastic\Elasticsearch\Exception\ClientResponseException
     * @throws \Elastic\Elasticsearch\Exception\MissingParameterException
     * @throws \Elastic\Elasticsearch\Exception\ServerResponseException
     */
    public function created(Article $article): void
    {
        $client = ClientBuilder::create()
            ->setHosts([config('services.search.hosts')])
            ->build();

        $client->index([
            'index' => $article->getSearchIndex(),
            'type' => $article->getSearchType(),
            'id' => $article->getKey(),
            'body' => $article->toSearchArray(),
        ]);
    }

    /**
     * Handle the Article "updated" event.
     */
    public function updated(Article $article): void
    {
        $client = ClientBuilder::create()
            ->setHosts([config('services.search.hosts')])
            ->build();

        $client->update([
            'index' => $article->getSearchIndex(),
            'type' => $article->getSearchType(),
            'id'    => $article->getKey(),
            'body'  => $article->toSearchArray()
        ]);
    }

    /**
     * Handle the Article "deleted" event.
     */
    public function deleted(Article $article): void
    {
        $client = ClientBuilder::create()
            ->setHosts([config('services.search.hosts')])
            ->build();
        $client->delete([
            'index' => $article->getSearchIndex(),
            'type' => $article->getSearchType(),
            'id' => $article->getKey(),
        ]);
    }

    /**
     * Handle the Article "restored" event.
     */
    public function restored(Article $article): void
    {
        //
    }

    /**
     * Handle the Article "force deleted" event.
     */
    public function forceDeleted(Article $article): void
    {
        //
    }

    }
