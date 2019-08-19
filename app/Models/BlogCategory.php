<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class BlogCategory
 *
 * @package App\Models
 *
 * @property-read BlogCategory $parentCategory
 * @property-read string       $ParentTitle
 */
class BlogCategory extends Model
{
    use SoftDeletes;

    // Корневая категория
    const ROOT = 1;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'parent_id', 'slug', 'title', 'description',
    ];

    /**
     * Получить родительскую категорию
     *
     * @return BlogCategory
     **/
    public function parentCategory()
    {
        return $this->belongsTo(BlogCategory::class, 'parent_id', 'id');
    }

    /**
     * Пример Accessor
     *
     * @return string
     **/
    public function getParentTitleAttribute()
    {
        $title = $this->parentCategory->title ?? ($this->isRoot() ? 'Корень' : '???');

        return $title;
    }

    /**
     * Undocumented function
     *
     * @return boolean
     */
    public function isRoot()
    {
        return $this->id == BlogCategory::ROOT;
    }
}
