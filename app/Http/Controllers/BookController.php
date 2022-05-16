<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Book;

class BookController extends Controller
{
    public function index()
    {
        $mga_libro = [];

        try {
            $mga_libro = Book::all();
        } catch (Exception $e) {
            $request->session()->flash('error', $e->getMessage());
        }
        
        return view('books', compact('mga_libro'));
    }

    public function showEditForm($id)
    {
        // SELECT * FROM books WHERE id=$id
        $friend = Book::find($id);
        return view('edit-book', compact('book'));
    }

    public function showNewForm()
    {
        return view('new-book-form');
    }

    public function saveBookChanges(Request $request)
    {
        try {
            $validated = $request->validate([
                'id' => 'required',
                'book_title' => 'required|max:100',
                'author_name' => 'required|max:100',
                'book_description' => 'required|max:100',
                'year_published' => 'required|max:20'
            ]);
            $id = $request->id;

            $book = Book::find($id);
            $result = $book->update([
                'book_title' => $request->book_title,
                'author_name' => $request->author_name,
                'book_description' => $request->book_description,
                'year_published' => substr($request->year_published, 0, 20),
                
            ]);

            if ($result == false) {
                $request->session()->flash('error', 'Unable to modify the record');
            } else {
                $request->session()->flash('message', 'Successfully updated record');
            }
        } catch (Exception $e) {
            $request->session()->flash('message', $e->getMessage());
        }

        return redirect('/books');
    }

    public function saveNewBook(Request $request)
    {
        $validated = $request->validate([
            'book_title' => 'required|max:100',
            'author_name' => 'required|max:100',
            'book_description' => 'required|max:100',
            'year_published' => 'required|max:20'
        ]);

        $book_title = $request->book_title;
        $author_name = $request->author_name;
        $book_description = $request->book_description;
        $year_published = substr($request->year_published, 0, 20);

        $book = Book::create([
            'book_title' => $book_title,
            'author_name' => $author_name,
            'book_description' => $book_description,
            'year_published' => $year_published
        ]);

        if (!is_null($book)) {
            $request->session()->flash('message', 'New book record has been added into the database');
        } else {
            $request->session()->flash('error', 'Unable to save new book record');
        }

        return redirect('/books');
    }

    public function deleteBook(Request $request, $id)
    {
        $book = Book::find($id);
        if (!is_null($book)) {
            $book->delete();
            $request->session()->flash('message', 'Record has been deleted');
        } else {
            $request->session()->flash('error', 'Unable to remove the record');
        }

        return redirect('/books');
    }
}
