<?php

// app/Services/UserService.php

namespace App\Services;

use App\Models\User;
use App\Repositories\UserRepository;

class UserService
{
    protected $userRepository;

    public function __construct(UserRepository $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    public function getAllUsers()
    {
        return $this->userRepository->getAllUsers();
    }

    public function getUserById($id)
    {
        return $this->userRepository->getUserById($id);
    }



    public function createUser(array $data): User
    {
        return $this->userRepository->createUser($data);
    }

    

    public function updateUser($id, $data)
    {

        return$this->userRepository->updateUser($id, $data);
    }
    public function deleteUser($id)
    {
        $this->userRepository->deleteUser($id);
    }
    public function getStats(array $params)
    {
        return $this->userRepository->getStats($params);
    }
 


}
