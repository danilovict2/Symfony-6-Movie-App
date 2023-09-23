<?php

namespace App\Twig\Components;

use App\TMDB\TMDB;
use Symfony\UX\LiveComponent\Attribute\AsLiveComponent;
use Symfony\UX\LiveComponent\Attribute\LiveProp;
use Symfony\UX\LiveComponent\DefaultActionTrait;

#[AsLiveComponent()]
final class SearchDropdown
{
    use DefaultActionTrait;

    #[LiveProp(writable: true)]
    public string $query = '';

    public function __construct(private TMDB $movieDB)
    {
    }

    public function getSearchResults(): array
    {
        return $this->movieDB->getSearchResults($this->query);
    }
}
