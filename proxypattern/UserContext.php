<?php
class UserContext {
    private string $role;

    public function __construct(string $role) {
        $this->role = $role;
    }

    public function hasPermission(string $permission): bool {
        $permissions = [
            'Admin' => [],
            'Donor' => ['PAYMENT'],
            'Volunteer' => []
        ];

        return in_array($permission, $permissions[$this->role] ?? []);
    }

    public function getRole(): string {
        return $this->role;
    }
}
?>