<?php

namespace App\Observers;

use App\Models\BlogCategory;
use Illuminate\Support\Str;

class BlogCategoryObserver
{
    /**
     * Обработка ПЕРЕД созданием записи
     *
     * @param BlogCategory $blogCategory
     **/
    public function creating(BlogCategory $blogCategory)
    {
        $this->setSlug($blogCategory);
    }

    /**
     * Обработка ПЕРЕД обновлением записи
     *
     * @param BlogCategory $blogCategory
     **/
    public function updating(BlogCategory $blogCategory)
    {
        $this->setSlug($blogCategory);
    }

    /**
     * Если поле slug пустое, то заполняем его конвертацией заголовка
     *
     * @param BlogCategory $blogCategory
     **/
    protected function setSlug(BlogCategory $blogCategory)
    {
        if (empty($blogCategory->slug)) {
            $blogCategory->slug = Str::slug($blogCategory->title);
        }
    }
}
