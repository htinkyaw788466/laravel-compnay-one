@extends('admin.admin_master')

@section('content')
    <div class="py-12">
        <div class="container">
            <div class="row">

                <h4>Contact Page </h4>
                <a href="{{ route('contact.create') }}"> <button class="btn btn-info">Add Contact</button> </a>
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


                        <div class="card-header"> All Contact Data </div>


                        <table class="table">
                            <thead>
                                <tr>
                                    <th scope="col" width="5%">SL </th>
                                    <th scope="col" width="15%">Contact Address</th>
                                    <th scope="col" width="25%">Contact Email</th>
                                    <th scope="col" width="15%">Contact Phone</th>
                                    <th scope="col" width="15%">Edit</th>
                                    <th scope="col" width="15%">Delete</th>
                                </tr>
                            </thead>
                            <tbody>
                                @php($i = 1)
                                @foreach ($contacts as $contact)
                                    <tr>
                                        <th scope="row"> {{ $i++ }} </th>
                                        <td> {{ $contact->address }} </td>
                                        <td> {{ $contact->email }} </td>
                                        <td> {{ $contact->phone }} </td>

                                        <td>
                                            <a href="{{ route('contact.edit',$contact->id) }}" class="btn btn-info"><i class="fa-solid fa-pen-to-square"></i></a>

                                        </td>
                                        <td><a href="{{ route('contact.destroy',$contact->id) }}" class="btn btn-danger"><i class="fa-solid fa-trash"></i></a></td>


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
