<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Hi.. <b>{{ Auth::user()->name }}</b>
            <b style="float: right">All Category
                <span>

                </span>
            </b>
        </h2>
    </x-slot>

    <div class="py-12">


        <div class="container">
            <div class="row">
                <div class="col-md-8">

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
                            All Category
                        </div>
                        <br>

                        @unless (count($categories)==0)

                        <table class="table">
                            <thead>
                                <tr>
                                    <th scope="col">SL No</th>
                                    <th scope="col">category</th>
                                    <th scope="col">User</th>
                                    <th scope="col">created_at</th>
                                    <th scope="col">Action</th>
                                </tr>
                            </thead>
                            <tbody>

                                @php
                                    $i=1;
                                @endphp



                                @foreach ($categories as $category)
                                    <tr>
                                        <th scope="row">{{ $categories->firstItem()+$loop->index }}</th>
                                        <th>{{ $category->category_name }}</th>
                                        <th>{{ $category->user->name }}</th>
                                        <th>{{ $category->created_at->diffForHumans() }}</th>
                                        {{-- <th>{{ $category->name }}</th>
                                        <th>{{ Carbon\Carbon::parse($category->created_at)->diffForHumans() }}</th> --}}
                                        <th>
                                            <a href="{{ route('edit.category',$category->id) }}" class="btn btn-info">Edit</a>
                                            <a href="{{route('soft-destroy.category',$category->id)}}" class="btn btn-danger">Delete</a>
                                        </th>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                        {{ $categories->links() }}

                        @else

                          <p>No category Found</p>

                        @endunless
                    </div>
                </div>



                <div class="col-md-4">
                    <div class="card">
                        <div class="card-header text-center">
                            Add Category
                        </div>
                        <div class="card-body">
                            <form action="{{ route('store.category') }}" method="post">
                                @csrf
                                <div class="form-group">
                                    <label for="category">Category Name</label>
                                    <input type="text" name="category_name" class="form-control @error('category_name') is-invalid @enderror" >
                                    @error('category_name')
                                        <span class="invalid-feedback" role="alert">
                                        <strong>{{$message}}</strong>
                                        </span>
                                    @enderror
                                </div>
                                <br>
                                <button type="submit" class="btn btn-primary">Add Category</button>
                            </form>
                        </div>
                    </div>
                </div>


            </div>
        </div>


        <!--Trash Part Section-->
        <div class="container">
            <div class="row">
                <div class="col-md-8">

                    <div class="card">

                        <div class="card-header">
                            Trash List
                        </div>
                        <br>


                        <table class="table">
                            <thead>
                                <tr>
                                    <th scope="col">SL No</th>
                                    <th scope="col">category</th>
                                    <th scope="col">User</th>
                                    <th scope="col">created_at</th>
                                    <th scope="col">Action</th>
                                </tr>
                            </thead>
                            <tbody>





                                @foreach ($trashCategory as $category)
                                    <tr>
                                        <th scope="row">{{ $categories->firstItem()+$loop->index }}</th>
                                        <th>{{ $category->category_name }}</th>
                                        <th>{{ $category->user->name }}</th>
                                        <th>{{ $category->created_at->diffForHumans() }}</th>
                                        {{-- <th>{{ $category->name }}</th>
                                        <th>{{ Carbon\Carbon::parse($category->created_at)->diffForHumans() }}</th> --}}
                                        <th>
                                            <a href="{{ route('restore.category',$category->id) }}" class="btn btn-info">Restore</a>
                                            <a href="{{route('permanently-destroy.category',$category->id)}}" class="btn btn-success">Permanently Delete</a>
                                        </th>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                        {{ $trashCategory->links() }}
                    </div>
                </div>



                <div class="col-md-4">
                </div>
            </div>
        </div>

    </div>
</x-app-layout>
