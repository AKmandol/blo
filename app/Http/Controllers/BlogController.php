<?php

namespace App\Http\Controllers;
use App\Models\Blog;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class BlogController extends Controller
{

    public function comment(Request $request, $id, Blog $blog){

        if (Auth::check()) {

            $blog = Blog::find($id);
            $blog->comment = $request->comment;
           
            $blog->save();

            //return $blog->update($request->all());
            // $blog = Blog::updateOrCreate(
            //     ['title' => 'sss',
            //     'description' => 'sss',
            //     'comment' => 'KKKK',]
            // );

            return redirect()->back()->with('success', 'Your Comment has been added');
        }

        return redirect()->back()->with('errors', 'You are not Authenticate to comment here! Log in first'); 
    }



    public function index()
    {
        $blogs = Blog::latest()->paginate(4);
        return view('blog.index',compact('blogs'))->with('i', (request()->input('page', 1) - 1) * 5);
    }




    public function create()
    {
        return view('blog.create');
    }




    public function store(Request $request)
    {
        //return "done";
        $request->validate([
            'title' => 'required',
            'slug' => 'required',
            'description' => 'required',
        ]);
  
        Blog::create($request->all());
        return redirect()->route('blog.index')->with('success','Blog Item created successfully.');
    }




    public function show(Blog $blog)
    {
        return view('blog.show',compact('blog'));
    }



    public function edit(Blog $blog)
    {
        return view('blog.edit',compact('blog'));
    }



    public function update(Request $request, Blog $blog)
    {
        $request->validate([
            'title' => 'required',
            'slug' => 'required',
            'description' => 'required',
        ]);

        $blog->update($request->all());
        return redirect()->route('blog.index')->with('success','Blog Item Updated successfully.');
    }



    public function destroy(Blog $blog)
    {
        $blog->delete();
        return redirect()->route('blog.index' )->with('success','Blog Item deleted successfully');
    }

    
}
