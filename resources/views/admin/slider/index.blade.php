@extends('admin.admin_master')

@section('content')

    <div class="py-12">
        <div class="container">
            <div class="row">
                <a href="{{ route('slider.create') }}" class="btn-btn-warning">Add</a>
                <div class="col-md-12">

                    @if (Session::has('success'))
                    <div class="alert alert-info">{{ Session::get('success') }}</div>
                  @endif

                  @if (Session::has('alert'))
                     <div class="alert alert-danger">{{ Session::get('alert') }}</div>
                  @endif

                  @if (Session::has('warning'))
                     <div class="alert alert-warning">{{ Session::get('warning') }}</div>
                  @endif

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
                            All Slider
                        </div>
                        <br>



                        <table class="table">
                            @unless (count($sliders)==0)
                            <thead>
                                <tr>
                                    <th scope="col" width="5%">SL No</th>
                                    <th scope="col" width="15%">Title</th>
                                    <th scope="col" width="15%">Description</th>
                                    <th scope="col" width="15%">Image</th>
                                    <th scope="col" width="15%">created_at</th>
                                    <th scope="col" width="15%">Edit</th>
                                    <th scope="col" width="15%">Delete</th>
                                </tr>
                            </thead>

                            <tbody>


                                @php
                                    $i=1;
                                @endphp



                                @foreach ($sliders as $slider)
                                    <tr>
                                        <th scope="row">{{ $i++; }}</th>
                                        <th>{{ $slider->title}}</th>
                                        <th>{{Str::limit($slider->description,30)}}</th>
                                        <th><img src="{{ Storage::disk('public')->url('slider/'.$slider->image) }}" style="height: 40px; width:70px;"></th>
                                        <th>{{ $slider->created_at->diffForHumans() }}</th>

                                        <th>
                                            <a href="{{ route('slider.edit',$slider->id) }}" class="btn btn-info"><i class="fa-solid fa-pen-to-square"></i></a>

                                        </th>
                                        <th><a href="{{ route('slider.destroy',$slider->id) }}" class="btn btn-danger"><i class="fa-solid fa-trash"></i></a></th>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>


                        @else

                          <p>No slider Found</p>

                        @endunless
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
