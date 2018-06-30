<?php

namespace App\Repositories;

use App\Article;
use App\Contracts\ArticleContract;

class ArticleRepository implements ArticleContract
{
    protected $model;

    /**
     * ArticleRepository constructor.
     * @param Article $article
     */
    public function __construct(Article $article)
    {
        $this->model = $article;
    }

    /**
     * @param $params
     * @return mixed
     */
    public function create($params)
    {
        return $this->model->create($params);
    }

    /**
     * @param $id
     * @return mixed
     */
    public function show($id)
    {
        return $this->model->where('id', $id)->first();
    }

    /**
     * @param $id
     * @param $params
     * @return mixed
     */
    public function update($id, $params)
    {
        return $this->model->where('id', $id)->update($params);
    }

    /**
     * @param $id
     * @return mixed
     */
    public function delete($id)
    {
        return $this->model->where('id', $id)->delete();
    }
}