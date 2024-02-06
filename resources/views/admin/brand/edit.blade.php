@extends('admin.admin_master')

@section('content')

    <div class="py-12">
        <div class="container">
            <div class="row">
                <div class="col-md-8">
                    <div class="card">
                        <div class="card-header text-center">Edit Brand</div>
                        <div class="card-body">
                            <form action="{{ route('update.brand',$brand->id) }}" method="post" enctype="multipart/form-data">
                                @csrf
                                @method('PUT')
                                <div class="form-group">
                                    <label for="brand_name">Brand Name</label>
                                    <input type="text" name="brand_name" class="form-control @error('brand_name') is-invalid @enderror"
                                    value="{{ $brand->brand_name }}">
                                    @error('brand_name')
                                        <span class="invalid-feedback" role="alert">
                                        <strong>{{$message}}</strong>
                                        </span>
                                    @enderror
                                </div>

                                <div class="form-group">
                                    <label for="brand_image">Brand Image</label>
                                    <input type="file" name="brand_image" class="form-control @error('brand_image') is-invalid @enderror">
                                    @error('brand_image')
                                        <span class="invalid-feedback" role="alert">
                                        <strong>{{$message}}</strong>
                                        </span>
                                    @enderror
                                </div>


                                <div class="form-group">
                                    <img src="{{ Storage::disk('public')->url('brand/'.$brand->brand_image)}}" style="width:400px; height:200px;" >

                                </div>
                                <br>
                                <a href="{{ route('all.brand') }}" class="btn btn-info">Back</a>
                                <button type="submit" class="btn btn-primary">Update Brand</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
