<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">Edit Category</h2>
    </x-slot>

    <div class="py-12">
        <div class="container">
            <div class="row">
                <div class="col-md-8">
                    <div class="card">
                        <div class="card-header text-center">Edit Category</div>
                        <div class="card-body">
                            <form action="{{ route('update.category',$category->id) }}" method="post">
                                @csrf
                                @method('PUT')
                                <div class="form-group">
                                    <label for="category">Category Name</label>
                                    <input type="text" name="category_name" class="form-control @error('category_name') is-invalid @enderror"
                                    value="{{ $category->category_name }}">
                                    @error('category_name')
                                        <span class="invalid-feedback" role="alert">
                                        <strong>{{$message}}</strong>
                                        </span>
                                    @enderror
                                </div>
                                <br>
                                <a href="{{ route('all.category') }}" class="btn btn-info">Back</a>
                                <button type="submit" class="btn btn-primary">Update Category</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
