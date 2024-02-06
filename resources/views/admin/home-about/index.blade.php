@extends('admin.admin_master')

@section('content')
    <div class="py-12">
        <div class="container">
            <div class="row">

                <a href="{{ route('about.create') }}"> <button class="btn btn-info">Add About</button> </a>
                <br><br>


                <div class="col-md-12">
                    <div class="card">


                        @if (session('success'))
                            <div class="alert alert-success alert-dismissible fade show" role="alert">
                                <strong>{{ session('success') }}</strong>
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                        @endif


                        <div class="card-header"> All About Data </div>


                        <table class="table">
                            <thead>
                                <tr>
                                    <th scope="col" width="5%">SL </th>
                                    <th scope="col" width="15%">Home Title</th>
                                    <th scope="col" width="25%">Short Description</th>
                                    <th scope="col" width="15%">Long Description</th>
                                    <th scope="col" width="15%">Edit</th>
                                    <th scope="col" width="15%">Delete</th>
                                </tr>
                            </thead>
                            <tbody>
                                @php($i = 1)
                                @foreach ($homeabouts as $about)
                                    <tr>
                                        <th scope="row"> {{ $i++ }} </th>
                                        <td> {{ $about->title }} </td>
                                        <td> {{ Str::limit($about->short_dis,20)}} </td>
                                        <td> {{ Str::limit($about->long_dis,40) }} </td>



                                            <td>
                                                <a href="{{ route('about.edit',$about->id) }}" class="btn btn-info"><i class="fa-solid fa-pen-to-square"></i></a>

                                            </td>
                                            <td><a href="{{ route('about.destroy',$about->id) }}" class="btn btn-danger"><i class="fa-solid fa-trash"></i></a></td>


                                    </tr>
                                @endforeach

                            </tbody>
                        </table>


                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
