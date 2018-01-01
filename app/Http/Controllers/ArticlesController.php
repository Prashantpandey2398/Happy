<?php

namespace App\Http\Controllers;

use App\Article;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;

class ArticlesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user = Auth::user();
        $articles = $user->articles;
        return view('articles.index', compact('articles'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('articles.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'body' => 'required'
        ]);

        $input = $request->all();

        $article = Article::create([
            'title' => $input['title'],
            'body' => $input['body'],
            'user_id' => Auth::id()
        ]);

        Session::flash('flash_message', 'Article successfully created');

        return redirect()->route('articles.show', $article->id);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $article = Article::find($id);
        if (Gate::allows('access-article', $article) || $article->make_public) {
            return view('articles.show', compact('article'));
        } else {
            abort(404);
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $article = Article::find($id);
        if(Auth::User()->id != $article->id)
            abort(404);
        if (Gate::allows('access-article', $article)) {
            return view('articles.edit', compact('article'));
        } else {
            return redirect()->back();
        }
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
        $this->validate($request, [
        ]);

        $input = $request->all();
        $article = Article::find($id);

        $article->update($input);

        Session::flash('flash_message', 'Article successfully updated');

        return redirect()->route('articles.show', $article->id);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $article = Article::find($id);

        $article->delete();

        Session::flash('flash_message', 'Article successfully deleted');

        return redirect()->back();
    }

    public function setting($id)
    {
        $article = Article::find($id);
        if(Auth::User()->id != $article->id)
            abort(404);
        if (Gate::allows('access-article', $article)) {
            return view('articles.setting', compact('article'));
        } else {
            return redirect()->back();
        }
    }
}
