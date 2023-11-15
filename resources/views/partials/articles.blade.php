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
