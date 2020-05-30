<?php

namespace Esprit\ApiBundle\Controller;

use Esprit\ApiBundle\Entity\Enfants;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Serializer\Normalizer\ObjectNormalizer;
use Symfony\Component\Serializer\Serializer;
use Symfony\Component\Serializer\Normalizer\DateTimeNormalizer;
use Symfony\Component\Validator\Constraints\DateTime;






class EnfantController extends Controller
{
    public function allAction()
    {
        $tasks = $this->getDoctrine()->getManager()
            ->getRepository('EspritApiBundle:Enfants')
            ->findAll();
        $serializer = new Serializer([new DateTimeNormalizer(), new ObjectNormalizer()]);
        $formatted = $serializer->normalize($tasks);
        return new JsonResponse($formatted);
    }

    public function findAction($id)
    {
        $tasks = $this->getDoctrine()->getManager()
            ->getRepository('EspritApiBundle:Enfants')
            ->find($id);
        $serializer = new Serializer([new ObjectNormalizer()]);
        $formatted = $serializer->normalize($tasks);
        return new JsonResponse($formatted);
    }

    public function newAction(Request $request)
    {
        $em = $this->getDoctrine()->getManager();
        $enfants = new Enfants();
        $enfants->setNom($request->get('nom'));
        $enfants->setPrenom($request->get('prenom'));
        $enfants->setSexe($request->get('sexe'));
        $enfants->setLieuNaissance($request->get('lieuNaissance'));
        $enfants->setDateNaissance($request->get('dateNaissance'));
        #$enfants->setDateNaissance(new \DateTime('dateNaissance'));
        $enfants->setMedicin($request->get('medicin'));
        $enfants->setMedecinNumero($request->get('medecinNumero'));
        $em->persist($enfants);
        $em->flush();
        $serializer = new Serializer([new ObjectNormalizer()]);
        $formatted = $serializer->normalize($enfants);
        return new JsonResponse($formatted);
    }

    public function supprimerEnfantAction($id)
    {

        $em = $this->getDoctrine()->getManager();
        $enfant = $em->getRepository('EspritApiBundle:Enfants')->find($id);
        $em->remove($enfant);
        $em->flush();
        $serializer = new Serializer([new ObjectNormalizer()]);
        $formatted = $serializer->normalize($enfant);
        return new JsonResponse($formatted);



    }

    public function findNomAction($nom)
    {
        $tasks = $this->getDoctrine()->getManager()
            ->getRepository('EspritApiBundle:Enfants')
            ->findBy(['nom'=>$nom]);
        $serializer = new Serializer([new ObjectNormalizer()]);
        $formatted = $serializer->normalize($tasks);
        return new JsonResponse($formatted);
    }
}
