<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBlogPostsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('blog_posts', function (Blueprint $table) {
            $table->bigIncrements('id');

            $table->bigInteger('category_id')->unsigned()->comment('id категории');
            $table->bigInteger('user_id')->unsigned()->comment('id автора');

            $table->string('slug')->unique()->comment('заголовок транслитом');
            $table->string('title')->comment('заголовок');

            $table->text('excerpt')->nullable()->comment('выдержка статьи');

            $table->text('content_raw')->comment('md текст');
            $table->text('content_html')->comment('html текст');

            $table->boolean('is_published')->default(false)->comment('статус публикации');
            $table->timestamp('published_at')->nullable()->comment('дата и время публикации');

            $table->timestamps();
            $table->softDeletes();

            $table->foreign('user_id')->references('id')->on('users');
            $table->foreign('category_id')->references('id')->on('blog_categories');
            $table->index('is_published');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('blog_posts');
    }
}
