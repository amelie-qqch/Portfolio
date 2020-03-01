<?php


namespace App\Business;

class ArticleCreationAction
{
    public $titre;
    public $competences;
    public $type;

    /**
     * @param $titre
     * @param $type
     * @param $competences
     * @return ArticleCreationAction
     */
    public static function create($titre, $type, $competences)
    {
        $action = new self();

        $action->titre = $titre;
        $action->competences = $competences;
        $action->type = $type;

        return $action;
    }
}