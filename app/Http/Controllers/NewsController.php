<?php

namespace App\Http\Controllers;

use App\Models\News;
use Illuminate\Http\Request;
use App\Http\Requests\StoreNewsRequest;
use App\Http\Requests\UpdateNewsRequest;
use App\Models\Categories;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Storage;
use Yajra\DataTables\DataTables;

class NewsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    private $model;
    private $title;
    public function __construct()
    {
        $this->model = new News();
        $routeName = Route::currentRouteName();
        $arr = explode('.', $routeName);
        $arr = array_map('ucfirst', $arr);
        $routeName = implode(' - ', $arr);
        $this->title = $routeName;
        View::share('title', $this->title);
    }

    public function index()
    {
        return view('admin.news.index');
    }

    public function getdata()
    {
        return Datatables::of($this->model::query())
            ->editColumn('created_at', function ($object) {
                // dd($object->getDate());
                return $object->getDate();
            })
            ->addColumn('title', function ($news) {
                $arr = [];
                $arr['link'] = route('news.show', ['news' => $news]);
                $arr['title'] = $news->title;
                return $arr;
            })
            ->addColumn('edit', function ($news) {
                return route('news.edit', ['news' => $news]);
            })
            ->addColumn('destroy', function ($news) {
                return route('news.destroy', ['news' => $news->id]);
            })
            ->filterColumn('title', function ($query, $keyword) {
                if ($keyword !== 'null') {
                    $query->where('id', $keyword);
                }
            })
            ->make(true);
    }

    public function newsClient(Request $request)
    {
        $listNews = News::all()->toQuery()->paginate(3);
        $id = $request->session()->get('id');
        $user = User::all()->find($id);
        $latestNews = News::orderBy('id', 'desc')->limit(3)->get();
        $categories = Categories::all();
        return view('clients.news.news', compact('listNews', 'user', 'latestNews', 'categories'));
    }


    public function getdataName(Request $request)
    {
        return $this->model
            ->where('title', 'like', '%' . $request->get('a') . '%')
            ->get(
                [
                    'id',
                    'title'
                ]
            );
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.news.create');
    }

    public function store(StoreNewsRequest $request)
    {
        // dd($request->file('news_img'));
        $path = Storage::disk('public')->put('/news_imgs', $request->file('news_img'));

        $news = $this->model::query()->create(
            [
                'title' => $request->get('title'),
                'content' => $request->get('content'),
                'image' => $path
            ]
        );

        // foreach ($request->file('news_img') as $file) {
        //     $path = Storage::disk('public')->put('/news_imgs', $file);

        //     DB::table('news_images')->insert(
        //         [
        //             'news_id' => $news['id'],
        //             'file_name' => $path,
        //             'type' => 'news_img'
        //         ]
        //     );
        // }
        return redirect()->route('news.index');
    }

    public function show(Request $request, $id)
    {
        $news = News::find($id);
        $id_user = $request->session()->get('id');
        $user = User::all()->find($id_user);
        $latestNews = News::orderBy('id', 'desc')->limit(3)->get();
        $categories = Categories::all();
        return view('clients.news.newsDetail', compact('news', 'user', 'latestNews', 'categories'));
    }

    public function edit(News $news)
    {
        return view('admin.news.edit', ['news' => $news]);
    }

    // Update
    public function update(UpdateNewsRequest $request, News $news)
    {
        $obj = $this->model->find($news->id);

        $path = $obj->image;
        // dd(!$request->hasFile('product_img'));
        if ($request->file('news_img') != null) {
            Storage::disk('public')->delete($path);
            $path = Storage::disk('public')->put('/news_imgs', $request->file('news_img'));
            // dd($path);
        }

        // dd($path);
        $obj->update([
            'title' => $request->get('title'),
            'content' => $request->get('content'),
            'image' => $path,
        ]);
        return redirect()->route('news.index');
    }

    public function destroy(News $news)
    {
        $this->model->find($news->id)->delete();

        $arr            = [];
        $arr['message'] = '';

        return response($arr, 200);
    }
}