<?php

namespace App\Twig\Extension;

use App\Twig\Runtime\HasRoleExtentionRuntime;
use Twig\Extension\AbstractExtension;
use Twig\TwigFilter;
use Twig\TwigFunction;

class HasRoleExtentionExtension extends AbstractExtension
{
    //symfony console make:twig-extension nom: HasRoleExtention
    public function getFilters(): array
    {
        return [
            // If your filter generates SAFE HTML, you should add a third
            // parameter: ['is_safe' => ['html']]
            // Reference: https://twig.symfony.com/doc/3.x/advanced.html#automatic-escaping
            new TwigFilter('has_role', [HasRoleExtentionRuntime::class, 'hasRole']),
        ];
    }

    public function getFunctions(): array
    {
        return [
           
        ];
    }
}
