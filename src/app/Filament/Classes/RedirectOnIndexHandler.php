<?php

namespace Filament\Classes\RedirectOnIndexHandler;

trait TraitRedirectOnIndex
{
    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }
}
