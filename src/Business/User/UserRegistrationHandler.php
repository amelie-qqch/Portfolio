<?php


namespace App\Business\User;


use App\Entity\User;
use App\Repository\UserRepository;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class UserRegistrationHandler
{
    /**
     * @var UserRepository
     */
    private $repository;

    /**
     * @var UserPasswordEncoderInterface
     */
    private $encoder;

    /**
     * UserRegistrationHandler constructor.
     * @param UserRepository $repository
     * @param UserPasswordEncoderInterface $encoder
     */
    public function __construct(UserRepository $repository, UserPasswordEncoderInterface $encoder)
    {
        $this->repository   = $repository;
        $this->encoder      = $encoder;
    }

    /**
     * @param UserRegistrationAction $action
     * @return User
     */
    public function handle(UserRegistrationAction $action)
    {
        $user = $this->repository->findOneBy(['email' => $action->email]);
        if($user instanceof User)
        {
            throw new UserAlreadyExistException();
        }

        $user           = new User($action->username, $action->email, $action->password);
        $hashedPassword = $this->encoder->encodePassword($user,$action->password);
        $user->changePassword($hashedPassword);

        $this->repository->create($user);
    }
}