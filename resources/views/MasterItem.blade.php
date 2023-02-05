@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">{{ __('Master Item') }}</div>

                    <div class="card-body">
                        @if (session('status'))
                            <div class="alert alert-success" role="alert">
                                {{ session('status') }}
                            </div>
                        @endif

                        <table class="table table-responsive table-striped">
                            <thead>
                                <td>#</td>
                                <td>Category</td>
                                <td>Item</td>
                                <td>Stock</td>
                                <td>Price</td>
                                <td>Action</td>
                            </thead>

                            @foreach ($items as $item)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $item->category->name }}</td>
                                    <td>{{ $item->name }}</td>
                                    <td>{{ $item->stock }}</td>
                                    <td>{{ $item->price }}</td>
                                    <td>
                                        <a href="{{ route('item.edit', $item->id) }}" class="btn btn-sm btn-warning">Edit</a>
                                        <a href="{{ route('item.hapus', $item->id) }}"
                                            onclick="return confirm('yakin ingin menghapus item ini?')"
                                            class="btn btn-sm btn-danger">Hapus</a>
                                    </td>
                                </tr>
                            @endforeach
                        </table>
                    </div>
                </div>
            </div>

            <div class="col-md-4">
                <div class="card">
                    <div class="card-header">{{ __('Add Item') }}</div>
                    <div class="card-body">

                        <form method="POST" enctype="multipart/form-data" action="{{ route('item.store') }}">
                            @csrf
                            <label for="category_id">Category</label>
                            <select name="category_id" class="form-control form-select" id="category_id">
                                @foreach ($categories as $category)
                                    <option value="{{ $category->id }}">{{ $category->name }}</option>
                                @endforeach
                            </select>
                            <label for="">Name</label>
                            <input required type="text" class="form-control" name="name">
                            <label for="">Stock</label>
                            <input required type="text" class="form-control" name="price">
                            <label for="">Price</label>
                            <input required type="text" class="form-control" name="stock"> <br>
                            <input class="btn btn-sm btn-success" type="submit" name="simpan" value="Simpan">
                            <input class="btn btn-sm btn-danger" type="reset" value="batal">
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
