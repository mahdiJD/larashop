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
                            <x-form action="{{$product->route('update')}}" method="PUT">
                            <div class="mb-3">
                                <img src="{{$product->fileURL()}}" alt="{{$product->name}}" class="img-fluid">
                            </div>
                            <div class="mb-3">
                                <label class="form-label" for="name">Name</label>
                                <input class="form-control @error('name') is-invalid @enderror"
                                type="text" name="name" id="name" value="{{old('name',$product->name)}}">
                                @error('name')
                                <div class="invalid-feedback"> {{$message}}</div>
                                @enderror
                            </div>
                            <div class="mb-3">
                                <label class="form-label" for="weight">Weight</label>
                                <input class="form-control @error('weight') is-invalid @enderror"
                                type="text" name="weight" id="weight" value="{{old('weight',$product->weight)}}">
                                @error('weight')
                                <div class="invalid-feedback"> {{$message}}</div>
                                @enderror
                            </div>
                            <div class="mb-3">Title
                                <label class="form-label" for="description">Description</label>
                                <input class="form-control @error('description') is-invalid @enderror"
                                type="text" name="description" id="description" value="{{old('description',$product->description)}}">
                                @error('description')
                                <div class="invalid-feedback"> {{$message}}</div>
                                @enderror
                            </div>
                            <div class="mb-3">
                                <label class="form-label" for="bio">Bio</label>
                                <textarea class="form-control @error('bio') is-invalid @enderror"
                                type="text" name="bio" id="bio" value="{{old('bio',$product->bio)}}">
                                @error('bio')
                                <div class="invalid-feedback"> {{$message}}</div>
                                @enderror
                            </div>
                            <div class="mb-3">
                                <label class="form-label" for="price">Price</label>
                                <textarea class="form-control @error('price') is-invalid @enderror"
                                type="text" name="price" id="price" value="{{old('price',$product->price)}}">
                                @error('price')
                                <div class="invalid-feedback"> {{$message}}</div>
                                @enderror
                            </div>
                            <div class="mb-3">
                                <label class="form-label" for="tags">Product Categories</label>
                                <input type="text" id="tags" name="tags"
                                class="form-control @error('tags')
                                is-invalid
                                @enderror"
                                value="{{old('tags',$product->tagString() )}}">
                                @error('tags')
                                <div class="invalid-feedback"> {{$message}}</div>
                                @enderror
                                <div class="form-text">
                                    Separate your tags with comma
                                </div>
                            </div>
                            <div class="mb-3">
                                <button type="submit" class="btn btn-primary">Update</button>
                                <a href="{{route('products.index')}}" class="btn btn-outline-secondary">Cancel</a>
                            </div>
                        </x-form>
                    </div>
                </div>

            </div>
        </div>
    </div>
@include('layouts.footer')
