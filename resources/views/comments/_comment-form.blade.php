@auth
    <x-form action="{{ route('comments.store' , $blog->slug)}}">
        <h4 class="mb-5 fw-bold">Leave a Reply</h4>
        <div class="row g-4">
            <div class="col-lg-12">
                <div class="border-bottom rounded my-4">
                    <textarea name="body" id="" class="form-control border-0 
                    @error('body')is-invalid @enderror"
                    cols="30" rows="8" placeholder="Your Review *" spellcheck="false"></textarea>
                    @error('body')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                    @enderror
                </div>
            </div>
            <div class="col-lg-12">
                <div class="d-flex justify-content-between py-3 mb-5">
                    <button class="btn border border-secondary text-primary rounded-pill px-4 py-3"> Post Comment</button>
                </div>
            </div>
        </div>
    </x-form>
@else
    <p class="text-muted">
        <a href="{{ route('login') }}">Sign in</a> to leave a comment!</p>
@endauth
