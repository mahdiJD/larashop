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
                    <div class="card-header">Upload your photo</div>

                    <div class="card-body">
                        <x-form action="{{route('products.store')}}" method="POST"
                        enctype="multipart/form-data">
                            <div class="mb-3">
                                <label class="form-label" for="file">File</label>
                                <input class="form-control @error('file') is-invalid @enderror" type="file" name="file" id="file">
                                @error('file')
                                    <div class="invalid-feedback"> {{$message}}</div>
                                    @else
                                    <div class="form-text">
                                        You can only upload your photo in following types: jpg & png
                                    </div>
                                @enderror
                            </div>
                            <div class="mb-3">
                                <label class="form-label" for="name">Name</label>
                                <input class="form-control @error('name') is-invalid @enderror" type="text" name="name" id="name" value="{{old('name')}}">
                                @error('name')
                                <div class="invalid-feedback"> {{$message}}</div>
                                @enderror
                            </div>
                            <div class="mb-3">
                                <label class="form-label" for="weight">Weight</label>
                                <input class="form-control @error('weight') is-invalid @enderror" type="text" name="weight" id="weight" value="{{old('weight')}}">
                                @error('weight')
                                <div class="invalid-feedback"> {{$message}}</div>
                                @enderror
                            </div>
                            <div class="mb-3">
                                <label class="form-label" for="description">Description</label>
                                <textarea name="description" id="description" class="form-control border-0 
                                    @error('description') is-invalid @enderror"
                                    cols="30" rows="8" placeholder="Your Review *" 
                                    spellcheck="false">{{old('description')}}</textarea>
                                @error('description')
                                <div class="invalid-feedback"> {{$message}}</div>
                                @enderror
                            </div>
                            <div class="mb-3">
                                <label class="form-label" for="bio">Bio</label>
                                <textarea name="bio" id="bio" class="form-control border-0 
                                    @error('bio') is-invalid @enderror"
                                    cols="30" rows="8" placeholder="Your Review *" 
                                    spellcheck="false">{{old('bio')}}</textarea>
                                @error('bio')
                                <div class="invalid-feedback"> {{$message}}</div>
                                @enderror
                            </div>
                            <div class="mb-3">
                                <label class="form-label" for="price">Price</label>
                                <input class="form-control @error('price') is-invalid @enderror"
                                 type="text" name="price" id="price" value="{{old('price')}}">
                                @error('price')
                                <div class="invalid-feedback"> {{$message}}</div>
                                @enderror
                            </div>
                            <div class="mb-3">
                                <label class="form-label" for="categorie">Product Categories</label>
                                <input type="text" id="categorie" name="categorie"
                                class="form-control @error('categorie')
                                is-invalid
                                @enderror"
                                value="{{old('categorie')}}">
                                @error('categorie')
                                <div class="invalid-feedback"> {{$message}}</div>
                                @enderror
                                <div class="form-text">
                                    Separate your categorie with comma
                                </div>
                            </div>
                            <div class="mb-3">
                                <button type="submit" class="btn btn-primary">Upload</button>
                                <a href="{{route('products.index')}}" class="btn btn-outline-secondary">Cancel</a>
                            </div>
                        </x-form>
                    </div>
                </div>

            </div>
        </div>
    </div>


    @include('layouts.footer')
