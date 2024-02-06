@extends('admin.admin_master')

@section('content')

    <div class="py-12">
        <div class="container">
            <div class="row">
                <div class="col-md-8">

                    {{-- @if (Session::has('success'))
                    <div class="alert alert-info">{{ Session::get('success') }}</div>
                  @endif

                  @if (Session::has('alert'))
                     <div class="alert alert-danger">{{ Session::get('alert') }}</div>
                  @endif

                  @if (Session::has('warning'))
                     <div class="alert alert-warning">{{ Session::get('warning') }}</div>
                  @endif --}}

                  {{-- @if (session('success'))
                       <div class="alert alert-warning alert-dismissible fade show" role="alert">
                          <strong>{{ session('success') }}</strong>
                          <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                              <span aria-hidden="true">&times;</span>
                          </button>
                       </div>
                  @endif --}}
                    <div class="card">


                        <div class="card-header text-center">
                            All Brand
                        </div>
                        <br>

                        @unless (count($brands)==0)

                        <table class="table">
                            <thead>
                                <tr>
                                    <th scope="col">SL No</th>
                                    <th scope="col">Brand Name</th>
                                    <th scope="col">Brand Image</th>
                                    <th scope="col">created_at</th>
                                    <th scope="col">Edit</th>
                                    <th scope="col">Delete</th>
                                </tr>
                            </thead>
                            <tbody>

                                @php
                                    $i=1;
                                @endphp



                                @foreach ($brands as $brand)
                                    <tr>
                                        <th scope="row">{{ $brands->firstItem()+$loop->index }}</th>
                                        <th>{{ $brand->brand_name }}</th>
                                        <th><img src="{{ Storage::disk('public')->url('brand/'.$brand->brand_image) }}" alt=""></th>
                                        <th>{{ $brand->created_at->diffForHumans() }}</th>
                                        {{-- <th>{{ $brand->name }}</th>
                                        <th>{{ Carbon\Carbon::parse($brand->created_at)->diffForHumans() }}</th> --}}
                                        <th>
                                            <a href="{{ route('edit.brand',$brand->id) }}" class="btn btn-info"><i class="fa-solid fa-pen-to-square"></i></a>

                                        </th>
                                        <th><a href="{{route('destroy.brand',$brand->id)}}" class="btn btn-danger"><i class="fa-solid fa-trash"></i></a></th>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                        {{ $brands->links() }}

                        @else

                          <p>No brand Found</p>

                        @endunless
                    </div>
                </div>



                <div class="col-md-4">
                    <div class="card">
                        <div class="card-header text-center">
                            Add Brand
                        </div>
                        <div class="card-body">
                            <form action="{{route('store.brand')}}" method="post" enctype="multipart/form-data">
                                @csrf
                                <div class="form-group">
                                    <label for="brand_name">Brand Name</label>
                                    <input type="text" name="brand_name" class="form-control @error('brand_name') is-invalid @enderror" >
                                    @error('brand_name')
                                        <span class="invalid-feedback" role="alert">
                                        <strong>{{$message}}</strong>
                                        </span>
                                    @enderror
                                </div>

                                <div class="form-group">
                                    <label for="brand_image">Brand Image</label>
                                    <input type="file" name="brand_image" class="form-control @error('brand_image') is-invalid @enderror" >
                                    @error('brand_image')
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
    </div>

@endsection
