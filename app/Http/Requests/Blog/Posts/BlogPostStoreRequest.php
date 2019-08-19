<?php

namespace App\Http\Requests\Blog\Posts;

class BlogPostStoreRequest extends BaseRequest
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
            'title' => ['unique:blog_posts',],
            'slug' => ['unique:blog_posts',],
        ]);
    }
}
