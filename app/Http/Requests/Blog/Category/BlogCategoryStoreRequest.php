<?php

namespace App\Http\Requests\Blog\Category;

class BlogCategoryStoreRequest extends BaseRequest
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
        return array_merge_recursive(parent::rules(), [
            'title' => ['unique:blog_categories',],
            'slug' => ['unique:blog_categories',],
        ]);
    }
}
