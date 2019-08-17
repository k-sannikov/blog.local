<?php

namespace App\Http\Requests\Blog\Posts;


class BlogPostUpdateRequest extends BaseRequest
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
        $id = $this::route('post');

        return array_merge_recursive(parent::rules(), [
            'slug' => ["unique:blog_posts,slug,$id,id",],
        ]);
    }
}
