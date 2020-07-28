<?php


namespace App\Business\Article;


class ArticleRemovalAction
{
    public $id;

    /**
     * @param $id
     * @return ArticleRemovalAction
     */
    public static function delete ($id)
    {
        $action = new self();

        $action->id = $id;
        return $action;
    }
}