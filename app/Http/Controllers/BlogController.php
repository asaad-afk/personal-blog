<?php

namespace App\Http\Controllers;

use App\Models\Blog;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Validator;

class BlogController extends Controller
{
    public function index(){
        $blogs = Blog::orderBy("created_at","desc")->paginate(5);
        return view("home",[
            "blogs"=>$blogs,
        ]);
    }
    public function create(){
        return view(route("create"));
    }
    public function store(Request $request){
        $valrules = [
            "title"=>"required|string|max:8",
            "content"=>"required|string|max:255",
        ];
        if($request->image != ""){
            $valrules["image"] = "image";
        }
        $validator = Validator::make($request->all(),$valrules);
        if($validator->fails()){
            return redirect(route("create"))->withInput()->withErrors($validator);
        }
        $blog = new Blog();
        $blog->title = $request->title;
        $blog->content = $request->content;
        $blog->save();
        if($request->image != ""){
            $image = $request->image;
            $ext = $image->getClientOriginalExtension();
            $imageName = time().".".$ext;
            $image->move(public_path("upload/blogupload"),$imageName);
            $blog->image = $imageName;
            $blog->save();
            return redirect(route("index"))->with("success","blog has been add successfully");
        }
        return back()->with("error","nothing has been add");
    }
    public function show($id){
        $fetchblog = Blog::findOrFail($id);
        return view(route("show"),[
            "blog"=>$fetchblog,
        ]);
    }
    public function edit($id){
        $fetchblog = Blog::findOrFail($id);
        return view(route("edit"),[
            "blog"=>$fetchblog,
        ]);
    }
    public function update(Request $request,$id){
        $fetchblog = Blog::findOrFail($id);
        $valrules = [
            "title"=>"required|string|max:8",
            "content"=>"required|string|max:255",
        ];
        if($request->image != ""){
            $valrules["image"] = "image";
        }
        $validator = Validator::make($request->all(),$valrules);
        if($validator->fails()){
            return back()->withInput()->withErrors($validator);
        }
        File::delete(public_path("upload/blogupload".$fetchblog->image));
        $fetchblog->title = $request->title;
        $fetchblog->content = $request->content;
        $fetchblog->save();
        if($request->image != ""){
            $image = $request->image;
            $ext = $image->getClientOriginalExtension();
            $imageName = time().".".$ext;
            $image->move(public_path("upload/blogupload"),$imageName);
            $fetchblog->image = $imageName;
            $fetchblog->save();
            return redirect(route("index"))->with("success","blog has been updated successfully");

        }
        return back()->with("error","blog has not been updated");
    }
    public function ajaxLike(Request $request)
    {
        $blog = Blog::find($request->id);
        $response = auth()->user()->toggleLikeDislike($blog->id, $request->like);

        return response()->json(['success' => $response]);
    }
    public function destroy($id){

        $deleteblog = Blog::findOrFail($id);
        File::delete(public_path("upload/blogupload".$deleteblog->image));
        $deleteblog->delete();
        return back()->with("success","blog has been deleted successfully");
    }

}
