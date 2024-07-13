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
                            
                            <x-form action="{{ $product->route('update') }}" method="PUT">
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
                                <div class="mb-3">
                                    <label class="form-label" for="description">Description</label>
                                    <textarea class="form-control @error('description') is-invalid @enderror"
                                    type="text" name="description" 
                                    id="description" >{{old('description',$product->description)}}</textarea>
                                    @error('description')
                                    <div class="invalid-feedback"> {{$message}}</div>
                                    @enderror
                                </div>
                                <div class="mb-3">
                                    <label class="form-label" for="bio">Bio</label>
                                    <textarea class="form-control @error('bio') is-invalid @enderror"
                                    type="text" name="bio" id="bio">{{old('bio',$product->bio)}}</textarea>
                                    @error('bio')
                                    <div class="invalid-feedback"> {{$message}}</div>
                                    @enderror
                                </div>
                                <div class="mb-3">
                                    <label class="form-label" for="price">Price</label>
                                    <input class="form-control @error('price') is-invalid @enderror"
                                    type="text" name="price" id="price" value="{{old('price',$product->price)}}">
                                    @error('price')
                                    <div class="invalid-feedback"> {{$message}}</div>
                                    @enderror
                                </div>
                                <div class="mb-3">
                                    <label class="form-label" for="categorie">Product Categorie</label>
                                    <input type="text" id="categorie" name="categorie"
                                    class="form-control @error('categorie')
                                    is-invalid
                                    @enderror"
                                    value="{{old('categorie',$product->categorieString() )}}">
                                    @error('categorie')
                                    <div class="invalid-feedback"> {{$message}}</div>
                                    @enderror
                                    <div class="form-text">
                                        Separate your categorie with comma
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
    </div>
@include('layouts.footer')
