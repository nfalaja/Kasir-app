@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">{{ __('Edit category') }}</div>

                    <div class="card-body">
                        {{-- @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif --}}

                        <form method="POST" enctype="multipart/form-data"
                            action="{{ route('category.update', $categories->id) }}">
                            @csrf
                            {{ method_field('PUT') }}
                            <div class="form-group">
                                <label for="name">Nama Kategori</label>
                                <input class="form-control" type="text" name="name" id="name"
                                    value="{{ $categories->name }}"> <br>
                            </div>
                            <div>
                                <input type="submit" class="btn btn-sm btn-success" value="Simpan">
                                <button class="btn btn-sm btn-danger"><a href="{{route('category.index')}}"></a>Batal</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
