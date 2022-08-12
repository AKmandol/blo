<?php

namespace App\Http\Controllers;
use App\Models\Blog;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;

class BlogController extends Controller
{

    public function currentUserBlog(){

        $users = User::with(['blogs'])->find(Auth::id());

        //return $users->toArray();
        $i = 0;
        return view('blog.currentUserBlog',compact('users','i'));

    }


    public function comment(Request $request, $id, Blog $blog){

        if (Auth::check()) {

            $blog = Blog::find($id);
            $blog->comment = $request->comment;
            $blog->save();
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
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        if ($files = $request->file('image')) {
                $path = public_path('/uploads/');       
                $blogImage = date('YmdHis') . "." . $files->getClientOriginalExtension();
                $files->move($path, $blogImage);
                $insert['image'] = "$blogImage";

                $blog = new Blog();
                $blog->image = "$blogImage";
                $blog->user_id = Auth::id();
                $blog->title = $request->title;
                $blog->slug = $request->slug;
                $blog->description = $request->description;
                $blog->save();
             }

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
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        if ($files = $request->file('image')) {
                   
                $dest = public_path('/uploads/').$blog->image;

                if(File::exists($dest)){
                    File::delete($dest);
                }

                $path = public_path('/uploads/');       
                $blogImage = date('YmdHis') . "." . $files->getClientOriginalExtension();
                $files->move($path, $blogImage);
                $insert['image'] = "$blogImage";
                $blog->image = "$blogImage";
                $blog->user_id = Auth::id();
                $blog->title = $request->title;
                $blog->slug = $request->slug;
                $blog->description = $request->description;
                $blog->update();
             }

               return redirect()->route('blog.index')->with('success','Blog Item Updated successfully.');
    }



    public function destroy(Blog $blog)
    {
        $dest = public_path('/uploads/').$blog->image;

        if(File::exists($dest)){

            File::delete($dest);

        }

        $blog->delete();
        return redirect()->route('blog.index' )->with('success','Blog Item deleted successfully');
    }

    
}
