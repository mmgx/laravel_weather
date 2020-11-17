<?php

namespace App\Traits\Method;

trait UserMethod
{
    /**
     * @return bool
     */
    public function isAdmin(): bool
    {
        return $this->id === 1;
    }
}
