<?php

namespace App\Traits;

use App\Traits\Attribute\UserAttritute;
use App\Traits\Method\UserMethod;
use App\Traits\Relation\UserRelation;
use App\Traits\Scope\UserScope;

/**
 * Trait UserTrait
 * @package App\Traits
 */
trait UserTrait
{
    use UserAttritute, UserMethod, UserRelation, UserScope;
}
