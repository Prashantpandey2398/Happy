<?php

namespace App\Contracts;

interface ArticleContract
{

    /**
     * @param $params
     * @return mixed
     */
    public function create($params);

    /**
     * @param $id
     * @return mixed
     */
    public function show($id);

    /**
     * @param $id
     * @param $params
     * @return mixed
     */
    public function update($id, $params);

    /**
     * @param $id
     * @return mixed
     */
    public function delete($id);
}
