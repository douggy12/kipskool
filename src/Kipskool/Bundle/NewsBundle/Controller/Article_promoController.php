<?php

namespace Kipskool\Bundle\NewsBundle\Controller;

use Kipskool\Bundle\NewsBundle\Entity\Article_promo;
use Kipskool\Bundle\NewsBundle\Entity\Commentaire_article_promo;
use Kipskool\Bundle\NewsBundle\Entity\Ecole;
use Kipskool\Bundle\NewsBundle\Entity\Promo;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;use Symfony\Component\HttpFoundation\Request;

/**
 * Article_promo controller.
 * @ParamConverter("article_promo", options={"mapping" : {"article_promo_id" : "id"}})
 * @Route("article_promo")
 */
class Article_promoController extends Controller
{
    /**
     * Creates a new article_promo entity.
     * @ParamConverter("promo", options={"mapping" : {"promo_id" : "id"}})
     * @Route("new_article_promo/promo/{promo_id}", name="add_article_promo")
     * @Method({"GET", "POST"})
     */
    public function newArtcicleAction(Request $request, Promo $promo )
    {
        $article_promo = new Article_promo();
        $article_promo->setPromo($promo);
        $form = $this->createForm('Kipskool\Bundle\NewsBundle\Form\Article_promoType', $article_promo);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($article_promo);
            $em->flush($article_promo);

            return $this->redirectToRoute('promo_show', array(
                'ecole_id'=>$promo->getEcole()->getId(),
                'promo_id' => $promo->getId()));
        }

        return $this->render('article_promo/new.html.twig', array(
            'ecole' => $promo->getEcole()->getId(),
            'promo'=>$promo,
            'article_promo' => $article_promo,
            'form' => $form->createView(),
        ));
    }
    /**
     * Finds and displays a article_promo entity.
     *
     * @Route("/{article_promo_id}", name="article_promo_show")
     * @Method({"GET", "POST"})
     */
    public function showArticleAction(Article_promo $article_promo, Request $request)
    {
        $commentaire_article_promo = new Commentaire_article_promo();
        $commentaire_article_promo->setArticlePromo($article_promo);
        $form = $this->createForm('Kipskool\Bundle\NewsBundle\Form\Commentaire_article_promoType', $commentaire_article_promo);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($commentaire_article_promo);
            $em->flush($commentaire_article_promo);

            return $this->redirectToRoute('article_promo_show', array(
                'promo_id'=>$article_promo->getPromo()->getId(),
                'article_promo_id' => $article_promo->getId()
            ));
        }

        return $this->render('article_promo/show.html.twig', array(
            'article_promo' => $article_promo,
            'promo'=>$article_promo->getPromo(),
            'commentaire_article_promo' => $commentaire_article_promo,
            'form' => $form->createView(),
        ));
    }
    /**
     * Displays a form to edit an existing article_promo entity.
     *
     * @Route("/{article_promo_id}/edit", name="article_promo_edit")
     * @Method({"GET", "POST"})
     */
    public function editArticleAction(Request $request, Article_promo $article_promo)
    {
        $editForm = $this->createForm('Kipskool\Bundle\NewsBundle\Form\Article_promoType', $article_promo);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('article_promo_show', array('article_promo_id' => $article_promo->getId()));
        }

        return $this->render('article_promo/edit.html.twig', array(
            'promo'=>$article_promo->getPromo(),
            'article_promo' => $article_promo,
            'edit_form' => $editForm->createView(),
        ));
    }

    /**
     * Deletes a article_promo entity.
     *
     * @Route("/{article_promo_id}/delete", name="article_promo_delete")
     * @Method("GET")
     */
    public function deleteAction(Article_promo $article_promo)
    {
            $em = $this->getDoctrine()->getManager();
            $em->remove($article_promo);
            $em->flush();

        return $this->redirectToRoute('promo_show', array('promo_id' => $article_promo->getPromo()->getId()));
    }

}
