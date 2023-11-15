<?php
namespace App\Repository\Interface;
use App\Models\Article;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

interface EloquentInterface
{
    public function all();

    public function pagination();
    public function search(string $query = '');

    public function searchOnElasticsearch(string $query = ''): array;
    public function buildCollection(array $ids):mixed;

}
