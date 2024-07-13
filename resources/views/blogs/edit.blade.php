@include('layouts.header')
<br>
<br>
<br>
<br>
<br>
<br>
<br>
    <div class="container-fluid mt-4">
        <div class="row">
            <div class="col-md-6 offset-md-3">
                <div class="card">
                    <div class="card-header">your photo</div>
                        <div class="card-body">
                            
                            <x-form action="{{ $blog->route('update') }}" method="PUT">
                                <div class="mb-3">
                                    <img src="{{$blog->fileURL()}}" alt="{{$blog->name}}" class="img-fluid">
                                </div>
                                <div class="mb-3">
                                    <label class="form-label" for="title">Title</label>
                                    <input class="form-control @error('title') is-invalid @enderror"
                                    type="text" name="title" id="title" value="{{old('title',$blog->title)}}">
                                    @error('title')
                                    <div class="invalid-feedback"> {{$message}}</div>
                                    @enderror
                                </div>
                                <div class="mb-3">
                                    <label class="form-label" for="body">Body</label>
                                    <textarea class="form-control @error('body') is-invalid @enderror"
                                    type="text" name="body" 
                                    id="body" >{{old('body',$blog->body)}}</textarea>
                                    @error('body')
                                    <div class="invalid-feedback"> {{$message}}</div>
                                    @enderror
                                </div>
                                <div class="mb-3">
                                    <label class="form-label" for="short">Short</label>
                                    <textarea class="form-control @error('short') is-invalid @enderror"
                                    type="text" name="short" id="short">{{old('short',$blog->short)}}</textarea>
                                    @error('short')
                                    <div class="invalid-feedback"> {{$message}}</div>
                                    @enderror
                                </div>
                                <div class="mb-3">
                                    <label class="form-label" for="tags">Blog Tags</label>
                                    <input type="text" id="tags" name="tags"
                                    class="form-control @error('tags')
                                    is-invalid
                                    @enderror"
                                    value="{{old('tags',$blog->tagString() )}}">
                                    @error('tags')
                                    <div class="invalid-feedback"> {{$message}}</div>
                                    @enderror
                                    <div class="form-text">
                                        Separate your tags with comma
                                    </div>
                                </div>
                                <div class="mb-3">
                                    <button type="submit" class="btn btn-primary">Update</button>
                                    <a href="{{route('blogs.index')}}" class="btn btn-outline-secondary">Cancel</a>
                                </div>
                            </x-form>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
@include('layouts.footer')
