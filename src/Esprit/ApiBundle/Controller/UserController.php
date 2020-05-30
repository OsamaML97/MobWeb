<?php

namespace Esprit\ApiBundle\Controller;

use Esprit\ApiBundle\Entity\Enfants;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Serializer\Normalizer\DateTimeNormalizer;
use Symfony\Component\Serializer\Normalizer\ObjectNormalizer;
use Symfony\Component\Serializer\Serializer;
use Esprit\ApiBundle\Entity\User;


class UserController extends Controller
{

    public function loginAction(Request $request){

        $username=$request->getUsername("username") ;
        $password=$request->getPassword("password") ;



        $entityManager = $this->getDoctrine()->getManager();
        $user = $this->getUser() ;
        $user = $this->getDoctrine()->getRepository('EspritApiBundle:User')->findOneBy(['username'=>$username]);
        $encoderService = $this->container->get('security.password_encoder') ;
        if($user != null) {
            $match = $encoderService->isPasswordValid($user, $password) ;
            if($match==true){
                $serializer = new Serializer([new ObjectNormalizer()]);
                $formatted = $serializer->normalize([$user]);
                return new JsonResponse($formatted);
            }
            else  {
                $serializer = new Serializer([new ObjectNormalizer()]);
                $formatted = $serializer->normalize(null);
                return new JsonResponse(123);
            }
        }
        else{
            $serializer = new Serializer([new ObjectNormalizer()]);
            $formatted = $serializer->normalize(null);
            return new JsonResponse(123);
        }





    }


    public function allAction()
    {
        $tasks = $this->getDoctrine()->getManager()
            ->getRepository('EspritApiBundle:User')
            ->findAll();
        $serializer = new Serializer([new DateTimeNormalizer(), new ObjectNormalizer()]);
        $formatted = $serializer->normalize($tasks);
        return new JsonResponse($formatted);
    }

    public function findByUsernameAction($username)
    {
        $tasks = $this->getDoctrine()->getManager()
            ->getRepository('EspritApiBundle:User')
            ->findByUsername(['username'=>$username]);
        $serializer = new Serializer([new ObjectNormalizer()]);
        $formatted = $serializer->normalize($tasks);
        return new JsonResponse($formatted);
    }

    public function newAction(Request $request)

    {


        $em = $this->getDoctrine()->getManager();

        $user = new User();
        $user->setUsername($request->get('username'));
        $user->setEmail($request->get('email'));
        $user->setPassword($request->get('password'));
        $em->persist($user);
        $em->flush();
        $serializer = new Serializer([new ObjectNormalizer()]);
        $formatted = $serializer->normalize($user);
        return new JsonResponse($formatted);
    }


}
