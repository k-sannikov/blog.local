<?php

namespace App\Http\Requests\Blog\Category;


class BlogCategoryUpdateRequest extends BaseRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return parent::authorize();
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        $id = $this::route('category');

        return array_merge_recursive(parent::rules(), [
            'title' => ["unique:blog_categories,title,$id,id",],
            'slug' => ["unique:blog_categories,slug,$id,id",],
        ]);
    }
}
