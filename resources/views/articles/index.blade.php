<div>
    @foreach ($articles as $article)
        <div>
            <a href="{{ route('articles.show', $article) }}">{{ $article->title }}</a> ({{ $article->getViewCount() }})
        </div>
    @endforeach
</div>
