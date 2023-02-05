@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8 ">
                <div class="card">
                    <div class="card-header">{{ __('Edit Item') }}</div>

                    <div class="card-body">
                        @if (session('status'))
                            <div class="alert alert-success" role="alert">
                                {{ session('status') }}
                            </div>
                        @endif

                        <form method="POST" enctype="multipart/form-data" action="{{ route('item.update' , $items->id) }}">
                            @csrf
                            {{ method_field('PUT') }}
                            <div class="form-group">
                                <label for="">Category</label>
                                <select name="category_id" class="form-control form-select" id="category_id">
                                    @foreach ($categories as $category)
                                        <option @if ($category->id == $items->category_id) selected @endif value="{{ $category->id }}">{{ $category->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="">Name</label>
                                <input required type="text" class="form-control" name="name" value="{{ $items->name }}">
                            </div>
                            <div class="form-group">
                                <label for="">Stock</label>
                                <input required type="text" class="form-control" name="stock" value="{{ $items->stock }}">
                            </div>
                            <div class="form-group">
                                <label for="">Price</label>
                                <input required type="text" class="form-control" name="price" value="{{ $items->price }}">
                            </div>
                            <div class="form-group mt-3">
                                <input class="btn btn-sm btn-success" type="submit" name="simpan" value="Simpan">
                                <button class="btn btn-sm btn-danger"><a href="{{route('item.index')}}"></a> Batal</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
