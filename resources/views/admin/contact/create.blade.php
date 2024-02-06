@extends('admin.admin_master')

@section('content')
    <div class="col-lg-12">
        <div class="card card-default">
            <div class="card-header card-header-border-bottom">
                <h2>Create Contact</h2>
            </div>
            <div class="card-body">
                <form action="{{ route('contact.store') }}" method="POST">
                    @csrf
                    <div class="form-group">
                        <label for="email">Contact Email </label>
                        <input type="email" name="email" class="form-control  @error('email') is-invalid @enderror" id="email"
                            placeholder="Contact Email">
                            @error('email')
                                <span class="invalid-feedback" role="alert">
                                <strong>{{$message}}</strong>
                                </span>
                            @enderror
                    </div>

                    <div class="form-group">
                        <label for="phone">Contact Phone </label>
                        <input type="text" name="phone" class="form-control  @error('phone') is-invalid @enderror" id="phone"
                            placeholder="Contact Phone">
                            @error('phone')
                                <span class="invalid-feedback" role="alert">
                                <strong>{{$message}}</strong>
                                </span>
                            @enderror

                    </div>



                    <div class="form-group">
                        <label for="address">Contact Adress</label>
                        <textarea class="form-control  @error('address') is-invalid @enderror" id="address" name="address">

                         </textarea>
                         @error('address')
                            <span class="invalid-feedback" role="alert">
                            <strong>{{$message}}</strong>
                            </span>
                         @enderror
                    </div>



                    <div class="form-footer pt-4 pt-5 mt-4 border-top">
                        <button type="submit" class="btn btn-primary btn-default">Submit</button>

                    </div>
                </form>
            </div>
        </div>
    @endsection
