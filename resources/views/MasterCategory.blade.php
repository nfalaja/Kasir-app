@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">{{ __('Master Category') }}</div>

                    <div class="card-body">
                        @if (session('status'))
                            <div class="alert alert-success" role="alert">
                                {{ session('status') }}
                            </div>
                        @endif

                        <table class="table table-responsive">
                            <thead>
                                <td>#</td>
                                <td>Nama Kategori</td>
                                <td>Action</td>
                            </thead>

                            @foreach ($categories as $category)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $category->name }}</td>
                                    <td>
                                        <a href="{{ route('category.edit', $category->id) }}"
                                            class="btn btn-warning btn-circle btn-sm">Edit</a>
                                        <a href="{{ route('category.hapus', $category->id) }}"
                                            class="btn btn-danger btn-sm "
                                            onclick="return confirm('yakin ingin menghapus?')">Hapus</a>
                                    </td>
                                </tr>
                            @endforeach
                        </table>
                    </div>
                </div>
            </div>

            <div class="col-md-4">
                <div class="card">
                    <div class="card-header">{{ __('Add Category') }}</div>
                    <div class="card-body">
                        <form method="POST" enctype="multipart/form-data" action="{{ route('category.store') }}">
                            @csrf
                            <input required type="text" name="name" id="name">
                            <input type="submit" class="btn btn-sm btn-success" value="simpan">
                            <input class="btn btn-sm btn-danger" type="reset" value="batal">
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
