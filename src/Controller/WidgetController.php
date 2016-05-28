<?php

namespace Jaguero\AboutmeBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;

class WidgetController extends Controller
{
    /**
     * @Template()
     */
    public function aboutmeAction()
    {
        $em = $this->getDoctrine()->getManager();
        $aboutMe = $em->getRepository("JagueroAboutmeBundle:Setting")->findAll();
        return array(
            'aboutme' => $aboutMe,
        );
    }
}
