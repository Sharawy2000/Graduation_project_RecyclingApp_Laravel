<!-- Display Posts -->
@foreach ($posts as $post)
    <div>
        <h2>{{ $post->title }}</h2>
        <p>{{ $post->content }}</p>

        <!-- Display Reactions -->
        @foreach ($post->reactions as $reaction)
            <p>{{ $reaction->reaction_type }}</p>
        @endforeach

        <!-- Display Comments -->
        @foreach ($post->comments as $comment)
            <p>{{ $comment->content }}</p>
        @endforeach
    </div>
@endforeach
