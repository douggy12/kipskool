<?php

namespace Kipskool\Bundle\NewsBundle\Controller;

use Kipskool\Bundle\NewsBundle\Entity\Perso;
use Kipskool\Bundle\NewsBundle\Entity\Promo;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;use Symfony\Component\HttpFoundation\Request;

/**
 * Perso controller.
 * @ParamConverter("perso", options={"mapping" : {"perso_id" : "id"}})
 * @Route("perso")
 */
class PersoController extends Controller
{

    /**
     * Finds and displays a perso entity.
     *
     * @Route("/{perso_id}", name="perso_show")
     * @Method("GET")
     */
    public function showAction(Perso $perso)
    {


        return $this->render('perso/show.html.twig', array(
            'promo' => $perso->getPromo(),
            'perso' => $perso,

        ));
    }

}
