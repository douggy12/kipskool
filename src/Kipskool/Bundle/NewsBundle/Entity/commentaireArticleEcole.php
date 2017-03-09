<?php

namespace Kipskool\Bundle\NewsBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * commentaireArticleEcole
 *
 * @ORM\Table(name="commentaire_article_ecole")
 * @ORM\Entity(repositoryClass="Kipskool\Bundle\NewsBundle\Repository\commentaireArticleEcoleRepository")
 */
class commentaireArticleEcole
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="texte", type="string", length=255)
     */
    private $texte;


    /**
     * Get id
     *
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set texte
     *
     * @param string $texte
     *
     * @return commentaireArticleEcole
     */
    public function setTexte($texte)
    {
        $this->texte = $texte;

        return $this;
    }

    /**
     * Get texte
     *
     * @return string
     */
    public function getTexte()
    {
        return $this->texte;
    }
}

