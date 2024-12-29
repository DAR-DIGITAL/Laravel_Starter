<?php

namespace App\Repositories;

use App\Models\User;
use App\Enums\User\UserStatus;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserRepository extends BaseRepository
{
    public function __construct()
    {
        parent::__construct(new User());
    }

    public function getAllUsers()
    {
        return User::orderByDesc('created_at')->all();
    }

    public function getUserById($id)
    {
        return User::findOrFail($id);
    }

    public function findByWpId(int $wpId): ?User
    {
        return User::where('wp_id', $wpId)->first();
    }

 

    public function createUser($data): User
    {
        return $this->create($data);
    }

    public function updateUser($id, $data)
    {
        $data = $data->all();
        $user = User::findOrFail($id);
        $data[User::PASSWORD_COLUMN] = isset($data[User::PASSWORD_COLUMN]) ? Hash::make($data[User::PASSWORD_COLUMN]) : $user->password;
        $user->update($data);

        return $user;
    }


    public function deleteUser($id)
    {
        $user = User::findOrFail($id);
        $user->delete();
    }

    public function getStats(array $params)
    {
        $allStatuses = UserStatus::getKeys();

        $adminsGroupedByStatus = User::whereHas('roles', function ($q) {
            $q->where('name', 'premium admin')->orWhere('name', 'basic admin');
        })
            ->select('status', DB::raw('COUNT(*) as total'))
            ->groupBy('status')
            ->whereIn('status', $allStatuses)
            ->get();

        $totalCount = User::whereHas('roles', function ($q) {
            $q->where('name', 'premium admin')->orWhere('name', 'basic admin');
        })
            ->count();

        $stats = collect([
            [
                'title' => 'total',
                'icon' => 'bi bi-clipboard-data',
                'color' => generateRandomColor(),
                'stats' => $totalCount,
            ],
        ]);

        foreach ($allStatuses as $status) {
            $admin = $adminsGroupedByStatus->where('status', $status)->first();

            $statusInfo = UserStatus::getStatusInfo()[$status] ?? null;

            $stats->push([
                'title' => UserStatus::getAll()[$status] ?? $status,
                'icon' => $statusInfo['icon'] ?? '',
                'color' => $statusInfo['color'] ?? generateRandomColor(),
                'stats' => $admin ? $admin->total : 0,
            ]);
        }

        return $stats;
    }


}
