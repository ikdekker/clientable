<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Client;
use AppBundle\Entity\Measurement;
use DateTime;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Form\Extension\Core\Type\DateTimeType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\HttpFoundation\Request;

class DefaultController extends Controller {

    /**
     * @Route("/", name="homepage")
     */
    public function indexAction(Request $request) {

    $authChecker = $this->container->get('security.authorization_checker');
    $router = $this->container->get('router');
	
    if (!$authChecker->isGranted('IS_AUTHENTICATED_REMEMBERED')) {
        return $this->redirectToRoute("fos_user_security_login");
    } 
        $clients = $this->getDoctrine()
                ->getRepository(Client::class)
                ->findAll();

        return $this->render('default/index.html.twig', [
                    'clients' => $clients,
        ]);
    }

    /**
     * @Route("/client/new", name="new_client")
     */
    public function newClientAction(Request $request) {
    $authChecker = $this->container->get('security.authorization_checker');
    $router = $this->container->get('router');
	
    if (!$authChecker->isGranted('IS_AUTHENTICATED_REMEMBERED')) {
        return $this->redirectToRoute("fos_user_security_login");
    } 
        $em = $this->getDoctrine()->getManager();

        $client = new Client();

        $form = $this->createFormBuilder($client)
                ->add('firstName', TextType::class)
                ->add('middleName', TextType::class, ["required" => false])
                ->add('lastName', TextType::class)
                ->add('initialWeight', TextType::class, ["required" => false])
                ->add('initialDate', DateType::class, ["required" => false, 'widget' => 'single_text'])
                ->add('save', SubmitType::class, array('label' => 'creëren'))
                ->getForm();

        if ($request->isMethod("POST")) {
            $formData = $request->get('form');
            $username = $formData['firstName'];
            $DT = isset($formData['initialDate']) ? new DateTime($formData['initialDate']) : new DateTime();
            $weight = str_replace(",", ".", $formData['initialWeight']);
            
            $client->setFirstName(ucfirst($formData['firstName']));
            $client->setLastName(ucfirst($formData['lastName']));
            $client->setMiddleName($formData['middleName']);
            $client->setInitialWeight($weight);
            $client->setInitialDate($DT);

            $em->persist($client);
            $em->flush();
            return $this->redirectToRoute("edit_client", ['user' => $client->getId()]);
        }

        return $this->render('client/new.html.twig', array(
                    'form' => $form->createView(),
        ));
    }

    /**
     * @Route("/measurement/new", name="new_measurement")
     */
    public function newMeasurementAction(Request $request) {
    $authChecker = $this->container->get('security.authorization_checker');
    $router = $this->container->get('router');
	
    if (!$authChecker->isGranted('IS_AUTHENTICATED_REMEMBERED')) {
        return $this->redirectToRoute("fos_user_security_login");
    } 
        $em = $this->getDoctrine()->getManager();
        $measurement = new Measurement();

        if ($request->isMethod("POST")) {
            $DT = new DateTime($request->get('measure_date'));
            $clientId = $request->get('client');
            $weight = str_replace(",", ".", $request->get('weight'));
            $measurement->setClient($clientId);
            $measurement->setWeight($weight);
			$measurement->setDate($DT);
            $em->persist($measurement);
            $em->flush();
            return $this->redirectToRoute("edit_client", ['user' => $clientId]);
        }
        echo 'iets ging fout - errorcode: newmeasurefail';
        exit;
    }

    function sortByDate($a, $b) {
        return strtotime($a["date"]) - strtotime($b["date"]);
    }

    /**
     * @Route("/client/edit/{user}", name="edit_client", requirements={"page": "\d+"})
     */
    public function editAction($user, Request $request) {
    $authChecker = $this->container->get('security.authorization_checker');
    $router = $this->container->get('router');
	
    if (!$authChecker->isGranted('IS_AUTHENTICATED_REMEMBERED')) {
        return $this->redirectToRoute("fos_user_security_login");
    } 
        $em = $this->getDoctrine()->getManager();

        $repo = $em->getRepository(Client::class);
        $client = $repo->find($user);
        $form = $this->createFormBuilder($client)
                ->add('firstName', TextType::class)
                ->add('middleName', TextType::class, ["required" => false])
                ->add('lastName', TextType::class)
                ->add('initialWeight', TextType::class, ["required" => false])
                ->add('initialDate', DateType::class, ["required" => true, 'widget' => 'single_text'])
                ->add('notes', TextareaType::class, ["required" => false])
                ->add('save', SubmitType::class, array('label' => 'Opslaan'))
                ->getForm();

        $measurements = $repo->getMeasurements($client->getId(), $em);

        if ($request->isMethod("POST")) {
            $formData = $request->get('form');
            $username = $formData['firstName'];
            $DT = isset($formData['initialDate']) ? new DateTime($formData['initialDate']) : new DateTime();
            $notes = $formData['notes'];
            $weight = str_replace(",", ".", $formData['initialWeight']);
            $client->setFirstName(ucfirst($formData['firstName']));
            $client->setLastName(ucfirst($formData['lastName']));
            $client->setMiddleName($formData['middleName']);
            $client->setInitialWeight($weight);
            $client->setInitialDate($DT);

            $client->setNotes($notes);



            $em->persist($client);
            $em->flush();
        }

        $form->setData($client);
        $measures = [];

        $measures[0]['date'] = $client->getInitialDate()->format("Y-m-d");
        $measures[0]['value'] = $client->getInitialWeight();
        foreach ($measurements as $cnt => $measurement) {
            $measures[$cnt + 1]['date'] = $measurement->getDate()->format("Y-m-d");
            $measures[$cnt + 1]['value'] = $measurement->getWeight();
        }
        usort($measures, [$this, "sortByDate"]);

        return $this->render('client/edit.html.twig', [
                    'form' => $form->createView(),
                    'client' => $client->getId(),
                    'measurements' => json_encode($measures)
        ]);
    }

    /**
     * @Route("/client/delete/{client_id}", name="delete_client", requirements={"client_id": "\d+"})
     */
    public function deleteAction($client_id, Request $request) {
		$authChecker = $this->container->get('security.authorization_checker');
		$router = $this->container->get('router');
		
		if (!$authChecker->isGranted('IS_AUTHENTICATED_REMEMBERED')) {
			return $this->redirectToRoute("fos_user_security_login");
		} 
		
        $em = $this->getDoctrine()->getManager();

        $repo = $em->getRepository(Client::class);
        $client = $repo->find($client_id);
        

        if ($request->isMethod("POST")) {
            $em->remove($client);
            $em->flush();
        }
		
        $measurements = $repo->getMeasurements($client->getId(), $em);
		$measureCount = count($measurements);
		
		$name = $client->getFirstName() . " " . $client->getLastName();
        
		return $this->redirectToRoute("homepage");
    }
}
