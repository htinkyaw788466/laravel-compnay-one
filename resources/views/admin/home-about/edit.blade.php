@extends('admin.admin_master')

@section('content')
    <div class="col-lg-12">
        <div class="card card-default">
            <div class="card-header card-header-border-bottom">
                <h2>Update HomeAbout</h2>
            </div>
            <div class="card-body">
                <form action="{{ route('about.update',$about->id) }}" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="form-group">
                        <label for="title">About Title </label>
                        <input type="text" name="title" class="form-control @error('title') is-invalid @enderror"
                            placeholder="Slider Title" value="{{ $about->title }}">
                            @error('title')
                                <span class="invalid-feedback" role="alert">
                                <strong>{{$message}}</strong>
                                </span>
                            @enderror

                    </div>



                    <div class="form-group">
                        <label for="short-des">Short Description</label>
                        <textarea class="form-control @error('short_dis') is-invalid @enderror" rows="3" name="short_dis">
                          {{ $about->short_dis }}
                        </textarea>
                        @error('short_dis')
                                <span class="invalid-feedback" role="alert">
                                <strong>{{$message}}</strong>
                                </span>
                            @enderror
                    </div>

                    <div class="form-group">
                        <label for="long-dis">Long Description</label>
                        <textarea class="form-control @error('long_dis') is-invalid @enderror" rows="3" name="long_dis">
                           {{ $about->long_dis }}
                        </textarea>
                        @error('long_dis')
                                <span class="invalid-feedback" role="alert">
                                <strong>{{$message}}</strong>
                                </span>
                        @enderror
                    </div>

                    <div class="form-footer pt-4 pt-5 mt-4 border-top">
                        <a href="{{ route('home.about') }}" class="btn btn-info">Back</a>
                        <button type="submit" class="btn btn-primary btn-default">Submit</button>

                    </div>
                </form>
            </div>
        </div>
    @endsection
