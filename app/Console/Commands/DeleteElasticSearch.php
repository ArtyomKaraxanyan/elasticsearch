<?php

namespace App\Console\Commands;

use App\Models\Article;
use App\Repository\Eloquent\ArticlesRepository;
use Elastic\Elasticsearch\ClientBuilder;
use Illuminate\Console\Command;

class DeleteElasticSearch extends Command
{
    public function __construct(Article $article)
    {
        parent::__construct();

        $this->article=$article;
    }

    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'search:delete';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     */
    public function handle()
    {

         $articles=Article::where('id')->first();

        $client = ClientBuilder::create()
            ->setHosts([config('services.search.hosts')])
            ->build();

        $params = ['index' => $articles->getSearchIndex()];

        $client->indices()->delete($params);


        }

    }
