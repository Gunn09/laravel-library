<?php

namespace App\Http\Controllers;

use App\Exports\BooksExport;
use App\Models\Books;
use Illuminate\Http\Request;
use App\Models\Category;
use Illuminate\Support\Facades\Auth;
use Maatwebsite\Excel\Facades\Excel;
use Spatie\PdfToImage\Pdf;
use App\Jobs\ProcessBook;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;

class BooksController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (request('cat')) {
            $books = Category::where('id', request('cat'))->firstOrFail()->book;
        } else {
            // $books = Books::latest()->paginate(5);
            $books = Books::all();
        }
        return view('book.index')->with([
            'books' => $books,
            'user_id' => Auth::id(),
            'categories' => Category::all()
        ]);
       
    }

    /*
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('book.create')->with([
            'user_id' => '1',
            'category' => Category::all()

        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if ($files = $request->file('file')) {
            $name = $files->getClientOriginalName();
            $files->move('images', $name);
        }
        $book = new Books;
        $book->title = $request['title'];
        $book->author = $request['author'];
        $book->file = $name;
        $book->thumbnail = $name.'.jpg';
        $book->detail = $request['detail'];
        $book->user_id = $request['user_id'];
        $book->save();
        $book->category()->attach($request['category_id']);

        // ProcessBook::dispatchNow($name);

        return redirect()->route('home_user');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $books = Books::find($id);
        return view('book.show', compact('books'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id$cat_id = Request::id;$cat_id = Request::id;
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
    public function export() 
    {
        return Excel::download(new BooksExport, 'book.xlsx');
    }

    public function category($cat_id)
    {
        // $books = Category::where('id',$cat_id)->firstOrFail()->book;
        // return view('book.index')->with([
        //     'books' => $books,
        //     'user_id' => Auth::id(),
        //     'categories' => Category::all()
        // ]);
    }

    public function newCategory(Request $request)
    {
        $input = $request->all();
        $category = Category::create([
            'name' => $input['name']
        ]);
        return response()->json(['success'=>'New Category Added']);
    }
}
