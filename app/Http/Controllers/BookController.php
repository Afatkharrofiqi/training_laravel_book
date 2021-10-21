<?php

namespace App\Http\Controllers;

use App\Models\Book;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class BookController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('book.index', ['books' => Book::paginate(10)]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('book.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'judul' => 'required|min:5',
            'tahun' => 'numeric|required',
            'cover' => 'mimes:jpg,png|max:10000'
        ]);

        $book = new Book();
        $book->judul = $request->judul;
        $book->tahun = $request->tahun;
        if($request->file('cover')) {
            $image_path = $request->file('cover')->store('cover_book', 'public');
            $book->cover = $image_path;
        }
        $book->save();

        $book->categories()->attach($request->categories);

        return redirect()->route('books.index')->with('status', 'Buku berhasil ditambahkan');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Book  $book
     * @return \Illuminate\Http\Response
     */
    public function show(Book $book)
    {

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Book  $book
     * @return \Illuminate\Http\Response
     */
    public function edit(Book $book)
    {
        return view('book.edit', ['book' => $book]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Book  $book
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Book $book)
    {
        $request->validate([
            'judul' => 'required|min:5',
            'tahun' => 'numeric|required',
            'cover' => 'mimes:jpg,png|max:10000'
        ]);

        $book->judul = $request->judul;
        $book->tahun = $request->tahun;
        if($request->file('cover')) {
            if($book->cover) {
                Storage::delete('public/'.$book->cover);
            }
            $image_path = $request->file('cover')->store('cover_book', 'public');
            $book->cover = $image_path;
        }
        $book->save();

        $book->categories()->sync($request->categories);

        return redirect()->route('books.index')->with('status', 'Buku berhasil diperbarui');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Book  $book
     * @return \Illuminate\Http\Response
     */
    public function destroy(Book $book)
    {
        $book->categories()->detach();
        if($book->cover) {
            Storage::delete('public/'.$book->cover);
        }
        $book->delete();

        return redirect()->route('books.index')->with('status', 'Buku berhasil dihapus');
    }
}
