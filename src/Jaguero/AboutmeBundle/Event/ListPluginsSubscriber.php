<?php

namespace Jaguero\AboutmeBundle\Event;

use Flowcode\DashboardBundle\Event\ListPluginsEvent;
use Flowcode\DashboardBundle\Event\ShowMenuEvent;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\Routing\RouterInterface;
use Symfony\Component\Translation\TranslatorInterface;


/**
 * Created by PhpStorm.
 * User: juanma
 * Date: 5/28/16
 * Time: 12:20 PM
 */
class ListPluginsSubscriber implements EventSubscriberInterface
{
    protected $router;
    protected $translator;

    public function __construct(RouterInterface $router, TranslatorInterface $translator)
    {
        $this->router = $router;
        $this->translator = $translator;
    }

    /**
     * Returns an array of event names this subscriber wants to listen to.
     *
     * @return array The event names to listen to
     */
    public static function getSubscribedEvents()
    {
        return array(
            ListPluginsEvent::NAME => array('handler', 0),
        );
    }


    public function handler(ListPluginsEvent $event)
    {
        $plugins = $event->getPluginDescriptors();

        /* add default */
        $plugins[] = array(
            "name" => "JagueroAboutMe",
            "image" => null,
            "version" => "v1.0",
            "settings" => $this->router->generate("admin_jaguero_setting"),
            "description" => "Plugin para agregar la información sobre del autor. Para usarlo, agregar en cualquier vista: {{ render(controller('JagueroAboutmeBundle:Widget:aboutme')) }}.",
            "website" => null,
            "authors" => array(
                array(
                    "name" => "Jaguero",
                    "email" => "jaguero@flowcode.com.ar",
                    "website" => "http://juanmaaguero.com",
                ),
            ),
        );

        $event->setPluginDescriptors($plugins);

    }
}