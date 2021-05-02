<?php

namespace App\Controller;

use App\Entity\Atelier;
use App\Entity\CommentaireAtelier;
use App\Repository\ActiviteSequenceTheoriqueRepository;
use App\Repository\CommentaireAtelierRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ApiPostController extends AbstractController {
    /**
     * @Route("/apip/commentaires_atelier/{id}", name="commentaires_atelier", methods={"GET"})
     */
    public function commentaires_atelier(CommentaireAtelierRepository $commentaireAtelierRepository, $id)
    {
        return $response = $this->json($commentaireAtelierRepository->findBy(['atelier' => $id]), 200, []);
    }

    /**
     * @Route("/apip/activites_sequence/{id}", name="activites_sequence", methods={"GET"})
     */
    public function activites_sequence(ActiviteSequenceTheoriqueRepository $activitesequencetheoriqueRepository, $id)
    {
        return $response = $this->json($activitesequencetheoriqueRepository->findBy(['idsequencetheorique' => $id]), 200, []);
    }

    /**
     * @Route("/apip/activite_sequence/{activite}/{sequence}", name="activite_sequence", methods={"GET"})
     */
    public function activite_sequence(ActiviteSequenceTheoriqueRepository $activitesequencetheoriqueRepository, $activite, $sequence)
    {
        return $response = $this->json($activitesequencetheoriqueRepository->findOneBy(['id' => $activite, 'idsequencetheorique' => $sequence]), 200, []);
    }

    /**
     * @Route(
     *     name="commentaires_atelier",
     *     path="/getCurrentUser",
     *     methods={"GET"})
     */
    public function getCurrentUser( ): Response {
        $this->denyAccessUnlessGranted('IS_AUTHENTICATED_FULLY');
        $user = $this->getUser();
        $user->eraseCredentials();
        return $this->json($user);
    }

    /**
     * @Route(
     *     name="nouveau_commentaire",
     *     path="/apip/nouveaucommentaire/{atelier}",
     *     methods={"POST"})
     */
    public function nouveauCommentaire(Request $request,Atelier $atelier,EntityManagerInterface $entityManager) {
        $this->denyAccessUnlessGranted('IS_AUTHENTICATED_FULLY');
        $user = $this->getUser();
        $nouveauCommentaire = $request->toArray();
        $commentaire = new CommentaireAtelier();
        $commentaire->setAtelier($atelier);
        $commentaire->setDate(new \DateTime());
        $commentaire->setTitre($nouveauCommentaire['title']);
        $commentaire->setMessage($nouveauCommentaire['message']);
        $commentaire->setProprietaire($user);
        $entityManager->persist($commentaire);
        $entityManager->flush();
        return $this->json($commentaire,201,[],['groups' => 'commentaire']);
    }

}
