<?php

namespace App\Repositories\Core;

use App\Models\Role;
use App\Repositories\BaseRepository;

class RoleRepository extends BaseRepository
{

    public function __construct(Role $role)
    {
        parent::__construct($role);
    }

}
