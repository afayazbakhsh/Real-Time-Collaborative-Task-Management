<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

abstract class RequestAbstract extends FormRequest
{
    /**
     * @var array{permissions: string[], roles: string[]}
     */
    protected array $access = [];

    /**
     * Check if the request is authorized.
     *
     * @return bool
     */
    public function authorize(): bool
    {
        return $this->hasAccess();
    }

    /**
     * Determine if the user has access based on roles and permissions.
     *
     * @return bool
     */
    private function hasAccess(): bool
    {
        return $this->hasRequiredRoles() && $this->hasRequiredPermissions();
    }

    /**
     * Check if the user has one of the required roles.
     *
     * @return bool
     */
    private function hasRequiredRoles(): bool
    {
        return $this->checkAccess('roles', 'hasRole');
    }

    /**
     * Check if the user has all the required permissions.
     *
     * @return bool
     */
    private function hasRequiredPermissions(): bool
    {
        return $this->checkAccess('permissions', 'hasPermission');
    }

    /**
     * Generalized access check based on type (roles or permissions).
     *
     * @param string $type
     * @param string $checkMethod
     * @return bool
     */
    private function checkAccess(string $type, string $checkMethod): bool
    {
        if (empty($this->access[$type])) {
            return true;
        }

        foreach ($this->access[$type] as $accessItem) {
            if ($this->user()->{$checkMethod}($accessItem)) {
                return true;
            }
        }

        return false;
    }
}
