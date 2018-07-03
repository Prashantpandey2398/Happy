<?php

namespace App\Http\Controllers;

use App\Contracts\ArticleContract;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;


class ArticlesController extends Controller
{
    protected $articlesRepo;

    public function __construct(ArticleContract $articlesContract)
    {
        $this->articlesRepo = $articlesContract;
    }

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
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'body' => 'required'
        ]);


        $request = $request->except(['_token', '_method', 'files']);

        $html_url = (Auth::User()->id)."_".time().".html";

        $myfile = fopen("uploads/artical/".$html_url, "w");
        fwrite($myfile, $request['body']);
        fclose($myfile);

        $params = [
            'title' => $request['title'],
            'body'  => $html_url,
            'user_id' => Auth::id()
        ];

        $article = $this->articlesRepo->create($params);

        Session::flash('flash_message', 'Article successfully created');
        return redirect()->route('articles.show', $article->id);
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $article = $this->articlesRepo->show($id);
        if (is_null($article)) {
            abort(404);
        }

        if ($article->make_public) {
            return view('articles.show', compact('article'));
        } elseif (Auth::check() && $article->user_id == Auth::User()->id) {
            return view('articles.show', compact('article'));
        } else {
            abort(404);
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        
        $article = $this->articlesRepo->show($id);

        if ($article->user_id == Auth::User()->id) {
            return view('articles.edit', compact('article'));
        } else {
            abort(404);
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $request = $request->except(['_token', '_method', 'files']);

        $html_url = (Auth::User()->id)."_".time().".html";

        $myfile = fopen("uploads/artical/".$html_url, "w");
        fwrite($myfile, $request['body']);
        fclose($myfile);
        
        $insert_data = [
            "title" => $request['title'],
            'body'  => $html_url
        ];

        $this->articlesRepo->update($id, $insert_data);
        $article = $this->articlesRepo->show($id);

        Session::flash('flash_message', 'Article successfully updated');
        return redirect()->route('articles.show', $article->id);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $this->articlesRepo->delete($id);
        Session::flash('flash_message', 'Article successfully deleted');

        return redirect()->back();
    }

    public function setting($id)
    {
        $article = $this->articlesRepo->show($id);
        if ($article->user_id == Auth::User()->id) {
            return view('articles.setting', compact('article'));
        } else {
            abort(404);
        }
    }

    public function upload_img(Request $request){

        $img_urls = [];

        foreach($request->file('file') as $value){
            $ext = $value->getClientOriginalExtension();
            $image_url = (Auth::User()->id)."_".time().rand(1,1000).".".$ext;

            $value->move('uploads/artical',$image_url);

            array_push($img_urls,url('uploads/artical/'.$image_url));
        }

        return $img_urls;
    }
}
