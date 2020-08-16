<?php


namespace App\Business\Tag;


use App\Entity\Tag;
use App\Repository\TagRepository;

class TagCreationHandler
{
    /**
     * @var TagRepository
     */
    private $repository;

    /**
     * TagCreationHandler constructor.
     * @param TagRepository $repository
     */
    public function __construct(TagRepository $repository)
    {
        $this->repository = $repository;
    }

    /**
     * @param TagCreationAction $action
     * @return Tag
     */
    public function handle(TagCreationAction $action):Tag
    {
        $tag = new Tag($action->name);
        $this->repository->create($tag);
        return $tag;
    }


}