<?php

namespace MissionControl\Bundle\UserBundle\Controller;

use Rhumsaa\Uuid\Uuid;
use Rhumsaa\Uuid\Exception\UnsatisfiedDependencyException;

use MissionControl\Bundle\UserBundle\Entity\User;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
// For generating documentation:
use Nelmio\ApiDocBundle\Annotation\ApiDoc;

// Preluate din controller exemplu:
use FOS\RestBundle\Util\Codes;
use FOS\RestBundle\Controller\Annotations;
use FOS\RestBundle\Controller\FOSRestController;
use Symfony\Component\Form\FormTypeInterface;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class UserController extends FOSRestController {

	/**
	 * @Route("/users/registration", name="_users_registration")
	 * @Method("POST")
	 *
	 * @ApiDoc(
	 *		resource = true,
	 *		description = "Registers a new user with given credentials.",
	 *		statusCodes = {
	 *			201 = "Returned when the new user has successfully been created.",
	 *			400 = "Returned when parameters used for registration are not valid."
	 *		},
	 *		parameters = {
	 *			{"name" = "username", "dataType"="text", "required"=true},
	 *			{"name" = "password", "dataType"="text", "required"=true},
	 *			{"name" = "email", "dataType"="text", "required"=true}
	 *		}
	 * )
	 *
	 */
	public function postUsersAction(Request $request) {

		// Create User instance and set property values:
		$user = new User();
		//$user = $userManager -> createUser();
		$user -> setUsername($request->request -> get('username'));
		$user -> setEmail($request->request -> get('email'));
		$user -> setPassword($request->request -> get('password'));

		//$password = $request->request -> get('password');
		//$confirm = $request->request -> get('confirm');

		// Create response object:
		$response = new Response();
		$response -> headers -> set('Content-Type', 'application/json');
		$serializer = $this -> get('jms_serializer');

		// Get validator service to check for errors:
		$validator = $this -> get('validator');
		$errors = $validator -> validate($user);

		if (count($errors) > 0) { 

			// Return $errors in JSON format:
			$view = $this -> view($errors, 400);
			return $this -> handleView($view);

		} // End of IF errors check.

		// Add user in database, create and return API key:
		// Encode password before persisting to database:
		$user -> setPassword(md5($request->request -> get('password')));
		$key = Uuid::uuid4() -> toString();
		$user -> setApiKey($key);

		// Persist user to database using entity manager:
		$em = $this -> getDoctrine() -> getManager();
		$em -> persist($user);
		$em -> flush();

		$response -> setStatusCode(201);
		$response -> setContent(json_encode(array(
			'Status' => 'User added to the database.'
			))
		);

		return $response;

	} // End of postUsersAction() method.

	/**
	 * @Route("/users/authentication", name="_users_authentication")
	 * @Method("POST")
	 *
	 * @ApiDoc(
	 *		resource = true,
	 *		description = "Returns API KEY for requested user.",
	 *		statusCodes = {
	 *			201 = "Returned when the user exists in the database and an API KEY has been returned.",
	 *			400 = "Returned when parameters used for authentication are not valid."
	 *		},
	 *		parameters = {
	 *			{"name" = "username", "dataType"="text", "required"=true},
	 *			{"name" = "password", "dataType"="text", "required"=true}
	 *		}
	 * )
	 *
	 */
	public function authenticationUsersAction(Request $request) {
		
		// Prepare Response configuration:
		$response = new Response();
		$response -> headers -> set('Content-Type', 'application/json');

		// Ask Users entity to check if user is in the database:
		$repository = $this -> getDoctrine() -> getRepository('MissionControl\Bundle\UserBundle\Entity\User');
		$user = $repository -> findOneBy(array(
			'username' => $request -> request -> get('username'),
			'password' => md5($request -> request -> get('password')),
			)
		); // Query for one user matching by username and password.

		// Return error information if user instance is not found:
		if (!$user) { 
			$response -> setStatusCode(400);
			$response -> setContent(json_encode(array(
				'Status' => 'Could not find a User with the given username and password.'
				))
			);
			return $response;
		}

		// Set status code and content:
		$response -> setStatusCode(201);

		// Retrieve API_KEY for $user:
		$key = $user -> getApiKey();
		$response -> setContent(json_encode(array(
				'API_KEY' => $key,
				)
			));
		return $response;
	
	} // End of authenticationUsersAction() method.

}