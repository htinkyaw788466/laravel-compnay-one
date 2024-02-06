@extends('admin.admin_master')

@section('content')

    <div class="py-12">

        <div class="container">
            <div class="row">
                @if (Session::has('success'))
                <div class="alert alert-info">{{ Session::get('success') }}</div>
              @endif
                <div class="col-md-8">
                    <div class="card-group">
                        @foreach($images as $multi)
                        <div class="col-md-4 mt-5">
                            <div class="card">
                                <img src="{{ Storage::disk('public')->url('multi/image/'.$multi->image) }}" alt="">
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>



                <div class="col-md-4">
                    <div class="card">
                        <div class="card-header">
                            Multi Image
                        </div>
                        <div class="card-body">
                            <form action="{{ route('multi.store') }}" method="post" enctype="multipart/form-data">
                                @csrf
                                <div class="form-group">
                                    <label for="image">Brand Image</label>
                                    <input type="file" name="image[]" class="form-control @error('image') is-invalid @enderror"
                                    multiple="">
                                    @error('image')
                                        <span class="invalid-feedback" role="alert">
                                        <strong>{{$message}}</strong>
                                        </span>
                                    @enderror
                                </div>
                                <br>
                                <button type="submit" class="btn btn-primary">Add Brand</button>
                            </form>
                        </div>
                    </div>
                </div>


            </div>
        </div>


        <!--Trash Part Section-->


    </div>

@endsection
