<?php

namespace App\Http\Controllers;

use App\Http\Requests\BlogRequest;
use App\Models\Blog;
use Illuminate\Support\Facades\Gate;
use function Symfony\Component\String\b;

class BlogController extends Controller
{
    public function __construct(protected $perPage = 5){
//        $this->middleware(['auth']);
//        $this->authorizeResource(blogs::class);
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $blogs =
            Blog::published()
                ->latest()
                ->paginate($this->perPage)
                -> WithQueryString();
        return view('blogs.index',compact('blogs'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        // if (Gate::denies('create')) {
        //     abort(403, "Access denied");
        // }
        $this->authorize('create-gate');
       return view('blogs.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(BlogRequest $request)
    {
        // if (Gate::denies('create')) {
        //     abort(403, "Access denied");
        // }
        $this->authorize('create-gate');
        $blog = Blog::create($data = $request->getData());
        $blog->syncTags($data['tags']);
        return to_route('blogs.index')->with('message','blogs has been uploaded Successfully');
    }
    /**
     * Display the specified resource.
     */
    public function show(Blog $blog)
    {
        $relatedBlogs = $blog->relatedBlogs();
        $comments = $blog->comments()->with('user')->approved()->latest()->get();
//        dd($comments);
        return view('blogs.show', compact('blog','comments','relatedBlogs'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Blog $blog)
    {
        // if (Gate::denies('update')) {
        //     abort(403, "Access denied");
        // }
        // if(!Gate::allows('update-blog', $blog)){
        //     return back()->with('message','Access Denied!');
        //     // abort(403,'Access Denied!');
        // }
        $this->authorize('delete-or-update-gate',$blog);
        return view('blogs.edit',compact('blog'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(BlogRequest $request, Blog $blog)
    {
        // if (Gate::denies('update')) {
        //     abort(403, "Access denied");
        // }
        $this->authorize('delete-or-update-gate',$blog);
        $blog->update($data = $request->getData());
        $blog->syncTags($data['tags']);
        return to_route('blogs.index')->with('message','blogs has been updated successfully!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Blog $blog)
    {
        // if (Gate::denies('delete')) {
        //     abort(403, "Access denied");
        // }
        // $this->authorize('delete-or-update-gate',$blog);
        Gate::authorize('delete', $blog);
        $blog->delete();
        return to_route('blogs.index')->with('message','blogs has been deleted successfully!');
    }
}
