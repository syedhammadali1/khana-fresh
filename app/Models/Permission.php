<?php

namespace App\Models;

use Spatie\Permission\Guard;
use Spatie\Permission\PermissionRegistrar;
use Spatie\Permission\Traits\HasRoles;
use Spatie\Permission\Traits\RefreshesPermissionCache;
use Spatie\Permission\Models\Permission as ParentPermission;
use Cviebrock\EloquentSluggable\Sluggable;
use Spatie\Permission\Exceptions\PermissionAlreadyExists;

class Permission extends ParentPermission
{
    use HasRoles;
    use RefreshesPermissionCache;
    use Sluggable;

    protected $fillable = ['name', 'display_name', 'guard_name', 'status'];


    /**
     * Return the sluggable configuration array for this model.
     *
     * @return array
     */
    public function sluggable(): array
    {
        return [
            'name' => [
                'source' => 'display_name',
                'separator' => '.'
            ]
        ];
    }

    public static function create(array $attributes = [])
    {
        $attributes['guard_name'] = $attributes['guard_name'] ?? Guard::getDefaultName(static::class);

        $permission = static::getPermission(['display_name' => $attributes['display_name'], 'guard_name' => $attributes['guard_name']]);

        if ($permission) {
            throw PermissionAlreadyExists::create($attributes['display_name'], $attributes['guard_name']);
        }

        return static::query()->create($attributes);
    }
}
