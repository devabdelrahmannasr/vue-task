<?php

namespace App\Repositories;

use App\Models\Article;

class ArticleRepository
{
    /**
     * Get all articles.
     *
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function getAll()
    {
        return Article::all();
    }

    /**
     * Get an article by ID.
     *
     * @param  int  $id
     * @return \App\Models\Article|null
     */
    public function getById($id)
    {
        return Article::find($id);
    }

    /**
     * Create a new article.
     *
     * @param  array  $data
     * @return \App\Models\Article
     */
    public function create(array $data)
    {
        return Article::create($data);
    }

    /**
     * Update an existing article by ID.
     *
     * @param  int    $id
     * @param  array  $data
     * @return \App\Models\Article|null
     */
    public function update($id, array $data)
    {
        $article = Article::find($id);

        if ($article) {
            $article->update($data);
        }

        return $article;
    }

    /**
     * Delete an article by ID.
     *
     * @param  int  $id
     * @return bool
     */
    public function delete($id)
    {
        $article = Article::find($id);

        if ($article) {
            return $article->delete();
        }

        return false;
    }
}