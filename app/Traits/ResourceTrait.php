<?php

namespace App\Traits;

trait ResourceTrait
{
    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }
}
