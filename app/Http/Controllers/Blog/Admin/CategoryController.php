<?php

namespace App\Http\Controllers\Blog\Admin;

use App\Models\BlogCategory;
use App\Http\Requests\Blog\Category\BlogCategoryUpdateRequest;
use App\Http\Requests\Blog\Category\BlogCategoryStoreRequest;
use Illuminate\Support\Str;
use App\Repositories\BlogCategoryRepository;

class CategoryController extends BaseController
{
    /**
     * @var BlogCategoryRepository
     */
    private $blogCategoryRepository;

    public function __construct()
    {
        parent::__construct();

        $this->blogCategoryRepository = app(BlogCategoryRepository::class);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $paginator = $this->blogCategoryRepository->getAllWithPaginate(15);


        return view('blog.admin.categories.index', compact('paginator'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categoryList = $this->blogCategoryRepository->getForSelect();

        return view('blog.admin.categories.create', compact('categoryList'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(BlogCategoryStoreRequest $request)
    {
        $item = BlogCategory::create($request->all());

        if ($item) {
            return redirect()
                ->route('blog.admin.categories.edit', $item->id)
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
        $item = $this->blogCategoryRepository->getEdit($id);

        $categoryList = $this->blogCategoryRepository->getForSelect();

        if (empty($item)) {
            abort(404);
        }

        return view('blog.admin.categories.edit', compact('item', 'categoryList'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(BlogCategoryUpdateRequest $request, $id)
    {
        $item = $this->blogCategoryRepository->getEdit($id);

        if (empty($item)) {
            return back()
            ->withErrors(['message' => "Запись id=[{$id}] не найдена",])
            ->withInput();
        }
        $data = $request->all();
        if (empty($data['slug'])) {
            $data['slug'] = Str::slug($data['title']);
        }

        $result = $item->update($data);

        if ($result) {
            return redirect()
                ->route('blog.admin.categories.edit', $item->id)
                ->with(['message' => ['success' => 'Успешно сохранено',]]);
        } else {
            return back()
                ->withErrors(['message' => 'Ошибка сохранения',])
                ->withInput();
        }
    }
}
