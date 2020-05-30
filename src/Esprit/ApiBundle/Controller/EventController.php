<?php

namespace Esprit\ApiBundle\Controller;

use Esprit\ApiBundle\Entity\Event;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Serializer\Normalizer\DateTimeNormalizer;
use Symfony\Component\Serializer\Normalizer\ObjectNormalizer;
use Symfony\Component\Serializer\Serializer;

class EventController extends Controller
{
    public function allAction()
    {
        $tasks = $this->getDoctrine()->getManager()
            ->getRepository('EspritApiBundle:Event')
            ->findAll();
        $serializer = new Serializer([new DateTimeNormalizer(), new ObjectNormalizer()]);
        $formatted = $serializer->normalize($tasks);
        return new JsonResponse($formatted);
    }

    public function findAction($id)
    {
        $tasks = $this->getDoctrine()->getManager()
            ->getRepository('EspritApiBundle:Event')
            ->find($id);
        $serializer = new Serializer([new ObjectNormalizer()]);
        $formatted = $serializer->normalize($tasks);
        return new JsonResponse($formatted);
    }

    public function newAction(Request $request)
    {
        $em = $this->getDoctrine()->getManager();
        $event = new Event();
        $event->setEvName($request->get('EvName'));
        $event->setEvMonth($request->get('EvMonth'));
        $event->setEvStart($request->get('EvStart'));
        $event->setEvEnd($request->get('EvEnd'));
        $event->setEvPur($request->get('EvPur'));
        #$enfants->setDateNaissance(new \DateTime('dateNaissance'));
        $event->setEvDesc($request->get('EvDesc'));
        $em->persist($event);
        $em->flush();
        $serializer = new Serializer([new ObjectNormalizer()]);
        $formatted = $serializer->normalize($event);
        return new JsonResponse($formatted);
    }

    public function supprimerEventAction($id)
    {

        $em = $this->getDoctrine()->getManager();
        $event = $em->getRepository('EspritApiBundle:Event')->find($id);
        $em->remove($event);
        $em->flush();
        $serializer = new Serializer([new ObjectNormalizer()]);
        $formatted = $serializer->normalize($event);
        return new JsonResponse($formatted);



    }
    public function findMonthAction($evMonth)
    {
        $tasks = $this->getDoctrine()->getManager()
            ->getRepository('EspritApiBundle:Event')
            ->findBy(['evMonth'=>$evMonth]);
        $serializer = new Serializer([new ObjectNormalizer()]);
        $formatted = $serializer->normalize($tasks);
        return new JsonResponse($formatted);
    }
}

