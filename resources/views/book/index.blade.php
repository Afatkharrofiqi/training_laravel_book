@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col">
                <div class="card">
                    <div class="card-header">Manage Book</div>

                    <div class="card-body">
                        <div class="row">
                            <div class="col-4 col-md-3 col-lg-2">
                                <a href="{{ route('books.create') }}" class="btn btn-dark btn-block mb-2">Add Book</a>
                            </div>
                        </div>
                        @if(session('status'))
                            <div class="alert alert-success">
                                {{ session('status') }}
                            </div>
                        @endif
                        <table class="table">
                            <thead class="thead-dark">
                                <tr>
                                    <th scope="col">#</th>
                                    <th scope="col">Judul</th>
                                    <th scope="col">Cover</th>
                                    <th scope="col">Tahun</th>
                                    <th scope="col">Kategori</th>
                                    <th scope="col" class="text-center">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($books as $key => $book)
                                    <tr>
                                        <th scope="row">{{ $books->firstItem() + $key }}</th>
                                        <td>{{ $book->judul }}</td>
                                        <td>
                                            @if($book->cover)
                                                <img src="{{ asset('storage/'.$book->cover) }}" width="100px" alt="book Cover">
                                            @else
                                                <p>Cover not set</p>
                                            @endif
                                        </td>
                                        <td>{{ $book->tahun }}</td>
                                        <td>
                                            <ul>
                                                @foreach($book->categories as $category)
                                                    <li>{{ $category->name }}</li>
                                                @endforeach
                                            </ul>
                                        </td>
                                        <td class="text-center">
                                            <a href="{{ route('books.edit', ['book' => $book->id]) }}" class="btn btn-primary">Edit</a>
                                            <form id="delete-form" action="{{ route('books.destroy', ['book' => $book->id]) }}" method="POST" class="d-inline-block mt-2 mt-lg-0">
                                                @csrf
                                                @method('delete')
                                                <input type="submit" class="btn btn-danger" value="Delete">
                                            </form>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="5" class="text-center">Buku tidak ditemukan</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                        <div class="float-right">
                            {{ $books->links() }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
