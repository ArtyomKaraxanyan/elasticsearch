@extends('layouts.app')
@section('content')
    <div class="container">
        <div class="card">
            <div class="card-header">
                Articles <small class="articles-count-content">({{ $articles->count() }})</small>
            </div>
            <div class="card-body">
                <form class="search-form" action="{{ route('home') }}" method="get">
                    <div class="form-group"  >
                        <input
                            type="text"
                            name="q"
                            class="form-control form-search"
                            placeholder="Search..."
                            value="{{request('q')}}"
                        />
                    </div>
                    <div class="container-search">
                        <div class="col-md-4 btn-div">
                            <button type="submit"  class=" btn btn-outline-primary w-100 search">Search</button>
                        </div>
                    </div>
                </form>
                <div class="articles-content">
                    @forelse ($articles as $article)
                        <article class="mb-3" >
                            <h2>{{ $article->title }}</h2>
                            <p class="m-0">{{ $article->body }}</p>
                            <div class="tags">
                                @foreach ($article->tags as $tag)
                                    <span class="badge badge-light" >{{$tag}}</span>
                                @endforeach
                            </div>
                        </article>
                    @empty
                        <p>No articles found</p>
                    @endforelse
                </div>
            </div>
            <div class="paginate">
            {{$articles->links("pagination::bootstrap-4")}}
            </div>

        </div>
    </div>
@endsection
