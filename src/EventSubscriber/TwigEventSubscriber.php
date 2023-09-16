<?php

namespace App\EventSubscriber;

use App\MovieDB;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\HttpKernel\Event\ControllerEvent;
use Twig\Environment;

class TwigEventSubscriber implements EventSubscriberInterface
{
    public function __construct(private Environment $twig, private MovieDB $movieDB)
    {
    }

    public function onControllerEvent(ControllerEvent $event): void
    {
        // array_column is used to convert $movieDB->getAllGenres() to form id => name for later convenience
        $genres = array_column($this->movieDB->getAllGenres(), 'name', 'id');
        
        $this->twig->addGlobal('genres', $genres);
    }

    public static function getSubscribedEvents(): array
    {
        return [
            ControllerEvent::class => 'onControllerEvent',
        ];
    }
}
