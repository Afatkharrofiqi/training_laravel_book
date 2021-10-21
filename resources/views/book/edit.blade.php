@extends('layouts.app')

@section('css')
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/css/select2.min.css" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@ttskch/select2-bootstrap4-theme@1.3.4/dist/select2-bootstrap4.min.css">
@endsection

@section('content')
    <div class="container">
        <div class="row">
            <div class="col">
                <div class="card">
                    <div class="card-header">Edit Book</div>

                    <div class="card-body">
                        @if ($errors->any())
                            <div class="alert alert-danger">
                                <ul>
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif
                        <form action="{{ route('books.update', ['book' => $book->id]) }}" method="post" enctype="multipart/form-data">
                            @csrf
                            @method('put')
                            <div class="form-group row">
                                <label for="name" class="col-sm-2 col-form-label">Judul</label>
                                <div class="col-sm-10">
                                    <input name="judul" type="text" class="form-control" id="name" value="{{ $book->judul }}" placeholder="Tuliskan judul" />
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="name" class="col-sm-2 col-form-label">Tahun</label>
                                <div class="col-sm-10">
                                    <input name="tahun" type="text" class="form-control" id="name" value="{{ $book->tahun }}" placeholder="Masukan tahun terbit" />
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="categories" class="col-sm-2 col-form-label">Categories</label>
                                <div class="col-sm-10">
                                    <select name="categories[]" id="categories" multiple class="form-control">
                                        @forelse($book->categories as $category)
                                            <option value="{{ $category->id }}" selected>{{ $category->name }}</option>
                                        @empty
                                            <option></option>
                                        @endforelse
                                    </select>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="cover" class="col-sm-2 col-form-label">Cover</label>
                                <div class="col-sm-10">
                                    <small class="text-muted">Current cover</small><br>
                                    @if($book->cover)
                                        <img src="{{asset('storage/' . $book->cover)}}" width="100px"/>
                                    @endif
                                    <input name="cover" type="file" class="form-control" id="cover"/>
                                    <small class="text-muted">*Kosongkan jika tidak ingin mengubah cover</small>
                                </div>
                            </div>
                            <div class="form-group">
                                <input type="submit" class="btn btn-dark mb-2" value="Submit">
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('javascript')
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/js/select2.min.js"></script>
    <script>
        $(function(){
            $('#categories').select2({
                placeholder: 'Choose category',
                ajax: {
                    url: '{{ route('categories.select')}}',
                    processResults: function(data){
                        return {
                            results: data.map(function(item){
                                return {id: item.id, text: item.name}
                            })
                        }
                    }
                }
            });
        })
    </script>
@endsection
