<?php

namespace App\Observers;

use App\Models\BlogPost;
use Illuminate\Support\Str;
use Carbon\Carbon;

class BlogPostObserver
{
    /**
     * Обработка ПЕРЕД созданием записи
     *
     * @param BlogPost $blogPost
     **/
    public function creating(BlogPost $blogPost)
    {
        $this->setPublishedAt($blogPost);

        $this->setSlug($blogPost);
    }

    /**
     * Обработка ПЕРЕД обновлением записи
     *
     * @param BlogPost $blogPost
     **/
    public function updating(BlogPost $blogPost)
    {
        $this->setPublishedAt($blogPost);

        $this->setSlug($blogPost);
    }

    /**
     * Если дата публикации не установлена и происходит установка флага - Опубликовано,
     * то устанавливаем дату публикации на текущую
     *
     * @param BlogPost $blogPost
     **/
    protected function setPublishedAt(BlogPost $blogPost)
    {
        $needSetPublished = empty($blogPost->published_at) && $blogPost->is_published;

        if ($needSetPublished) {
            $blogPost->published_at = Carbon::now();
        }
    }

    /**
     * Если поле slug пустое, то заполняем его конвертацией заголовка
     *
     * @param BlogPost $blogPost
     **/
    protected function setSlug(BlogPost $blogPost)
    {
        if (empty($blogPost->slug)) {
            $blogPost->slug = Str::slug($blogPost->title);
        }
    }
}
