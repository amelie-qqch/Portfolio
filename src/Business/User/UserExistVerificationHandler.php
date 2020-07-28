<?php


namespace App\Business\User;


use App\Repository\UserRepository;

class UserExistVerificationHandler
{
    /**
     * @var UserRepository
     */
    private $repository;

    /**
     * UserExistVerificationHandler constructor.
     * @param UserRepository $repository
     */
    public function __construct(UserRepository $repository)
    {
        $this->repository = $repository;
    }

    /**
     * @param $email
     * @return bool
     */
    public function handle($email): bool
    {
        $userExist = false;
        $user = $this->repository->findOneBy(['email' => $email]);

        if($user != null)
        {
            $userExist = true;
        }

        return $userExist;
    }




}