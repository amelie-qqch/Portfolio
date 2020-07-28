<?php

namespace App\Business\Article;

class ArticleReadingAction
{
    /**
     * @var integer
     */
    public $id;

    /**
     * @param $id
     *
     * @return ArticleReadingAction
     */
    public static function read($id): ArticleReadingAction
    {
        $action = new self();

        $action->id = $id;

        return $action;
    }
}
