<div class="tab-pane" id="nav-mission" role="tabpanel" aria-labelledby="nav-mission-tab">
    @foreach($comments as $comment)
    <div class="d-flex">
        <img src="{{ $comment->user->profileBlogUrl() }}" class="img-fluid rounded-circle p-3" style="width: 100px; height: 100px;" alt="{{ $comment->user->name }}">
        <div class="">
            <p class="mb-2" style="font-size: 14px;">{{ $comment->created_at->diffForHumans() }}</p>
            <div class="d-flex justify-content-between">
                <h5>{{ $comment->user->name }}</h5>
            </div>
            <p>{{ $comment->body }}</p>
        </div>
    </div>
    @endforeach
</div>
