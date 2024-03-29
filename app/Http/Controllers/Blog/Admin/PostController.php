<?php

namespace App\Http\Controllers\Blog\Admin;

use App\Models\BlogPost;
use App\Repositories\BlogPostRepository;
use App\Repositories\BlogCategoryRepository;
use Illuminate\Http\Request;
use App\Http\Requests\Blog\Posts\BlogPostUpdateRequest;
use App\Http\Requests\Blog\Posts\BlogPostStoreRequest;

class PostController extends BaseController
{
    /**
     * @var blogPostRepository
     */
    private $blogPostRepository;

    /**
     * @var blogPostRepository
     */
    private $blogCategoryRepository;

    public function __construct()
    {
        parent::__construct();

        $this->blogPostRepository = app(BlogPostRepository::class);
        $this->blogCategoryRepository = app(BlogCategoryRepository::class);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $paginator = $this->blogPostRepository->getAllWithPaginate(25);

        return view('blog.admin.posts.index', compact('paginator'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categoryList = $this->blogCategoryRepository->getForSelect();

        return view('blog.admin.posts.create', compact('categoryList'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(BlogPostStoreRequest $request)
    {
        $item = BlogPost::create($request->all());

        if ($item) {
            return redirect()
                ->route('blog.admin.posts.edit', $item->id)
                ->with(['message' => ['success' => 'Успешно сохранено',]]);
        } else {
            return back()
                ->withErrors(['message' => 'Ошибка сохранения',])
                ->withInput();
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  integer  $id
     *
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $item = $this->blogPostRepository->getEdit($id);

        $categoryList = $this->blogCategoryRepository->getForSelect();

        if (empty($item)) {
            abort(404);
        }

        return view('blog.admin.posts.edit', compact('item', 'categoryList'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     *
     * @return \Illuminate\Http\Response
     */
    public function update(BlogPostUpdateRequest $request, $id)
    {
        $item = $this->blogPostRepository->getEdit($id);

        if (empty($item)) {
            return back()
            ->withErrors(['message' => "Запись id=[{$id}] не найдена",])
            ->withInput();
        }

        $result = $item->update($request->all());

        if ($result) {
            return redirect()
                ->route('blog.admin.posts.edit', $item->id)
                ->with(['message' => ['success' => 'Успешно сохранено',]]);
        } else {
            return back()
                ->withErrors(['message' => 'Ошибка сохранения',])
                ->withInput();
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        dd(__METHOD__);
    }
}
