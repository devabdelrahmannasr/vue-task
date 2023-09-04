<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Repositories\ArticleRepository; 

class ArticlesController extends BaseController
{
    private $articleRepository;

    public function __construct(ArticleRepository $articleRepository)
    {
        $this->articleRepository = $articleRepository;
    }

    public function index()
    {
        try {
            $articles = $this->articleRepository->getAll();
            return $this->sendResponse($articles, 'Articles retrieved successfully');
        } catch (\Exception $e) {
            return $this->sendError('Error fetching articles', [], 500);
        }
    }

    public function show($id)
    {
        try {
            $article = $this->articleRepository->getById($id);

            if (!$article) {
                return $this->sendError('Article not found', [], 404);
            }

            return $this->sendResponse($article, 'Article retrieved successfully');
        } catch (\Exception $e) {
            return $this->sendError('Error fetching the article', [], 500);
        }
    }

    public function store(Request $request)
    {
        try {
        
            $validatedData = $request->validate([
                'title' => 'required|string|max:255',
                'content' => 'required|string',
            ]);

            $article = $this->articleRepository->create($validatedData);

            return $this->sendResponse($article, 'Article created successfully');
        } catch (\Exception $e) {
            return $this->sendError('Error creating the article'.$e->getMessage(), [], 500);
        }
    }

    public function update(Request $request, $id)
    {
        try {
         
            $validatedData = $request->validate([
                'title' => 'required|string|max:255',
                'content' => 'required|string',
            ]);

            $article = $this->articleRepository->update($id, $validatedData);

            if (!$article) {
                return $this->sendError('Article not found', [], 404);
            }

            return $this->sendResponse($article, 'Article updated successfully');
        } catch (\Exception $e) {
            return $this->sendError('Error updating the article', [], 500);
        }
    }

    public function destroy($id)
    {
        try {
            $deleted = $this->articleRepository->delete($id);

            if (!$deleted) {
                return $this->sendError('Article not found', [], 404);
            }

            return $this->sendResponse(null, 'Article deleted successfully');
        } catch (\Exception $e) {
            return $this->sendError('Error deleting the article', [], 500);
        }
    }
}