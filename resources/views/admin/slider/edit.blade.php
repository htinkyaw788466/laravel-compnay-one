@extends('admin.admin_master')

@section('content')
    <div class="col-lg-12">
        <div class="card card-default">
            <div class="card-header card-header-border-bottom">
                <h2>Update Slider</h2>
            </div>
            <div class="card-body">
                <form action="{{ route('slider.update',$slider->id) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <div class="form-group">
                        <label for="title">Slider Title </label>
                        <input type="text" name="title" class="form-control @error('title') is-invalid @enderror" id="title"
                            placeholder="Slider Title" value="{{ $slider->title }}">
                            @error('title')
                                <span class="invalid-feedback" role="alert">
                                <strong>{{$message}}</strong>
                                </span>
                            @enderror

                    </div>



                    <div class="form-group">
                        <label for="slider-description">Slider Description</label>
                        <textarea class="form-control @error('description') is-invalid @enderror" id="slider-description" rows="3" name="description">
                         {{ $slider->description }}
                       </textarea>

                      @error('description')
                        <span class="invalid-feedback" role="alert">
                        <strong>{{$message}}</strong>
                        </span>
                     @enderror
                    </div>
                    <div class="form-group">
                        <label for="image">Slider Image</label>
                        <input type="file" name="image" class="form-control-file @error('image') is-invalid @enderror" id="image"
                        >
                        @error('image')
                            <span class="invalid-feedback" role="alert">
                            <strong>{{$message}}</strong>
                            </span>
                       @enderror
                    </div>

                    <div class="form-footer pt-4 pt-5 mt-4 border-top">
                        <a href="{{ route('home.slider') }}" class="btn btn-info">Back</a>
                        <button type="submit" class="btn btn-primary btn-default">Update</button>

                    </div>
                </form>
            </div>
        </div>
    @endsection
