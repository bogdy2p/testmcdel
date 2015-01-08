<?php

namespace MissionControl\Bundle\ProjectBundle\Controller;

use MissionControl\Bundle\ProjectBundle\Entity\Project;

use MissionControl\Bundle\ProjectBundle\Entity\Lightxmlprojects;

use MissionControl\Bundle\ProjectBundle\Entity\Setups;
use MissionControl\Bundle\ProjectBundle\Entity\Objectives;
use MissionControl\Bundle\ProjectBundle\Entity\Touchpoints;
use MissionControl\Bundle\ProjectBundle\Entity\Cprattributes;
use MissionControl\Bundle\ProjectBundle\Entity\Budgetallocations;
use MissionControl\Bundle\ProjectBundle\Entity\Timeallocations;
            
use MissionControl\Bundle\ProjectBundle\Entity\Clients;
use MissionControl\Bundle\ProjectBundle\Entity\Surveys;
use MissionControl\Bundle\ProjectBundle\Entity\Targets;
use MissionControl\Bundle\ProjectBundle\Entity\Objectivescores;
use MissionControl\Bundle\ProjectBundle\Entity\Attributescores;
use MissionControl\Bundle\ProjectBundle\Entity\TimeTotal;
use MissionControl\Bundle\ProjectBundle\Entity\Touchpointtimeallocation;
use MissionControl\Bundle\ProjectBundle\Entity\BudgetAllocatedtouchpoints;
use MissionControl\Bundle\ProjectBundle\Entity\BudgetTotal;
use MissionControl\Bundle\ProjectBundle\Entity\Allocations;
use MissionControl\Bundle\ProjectBundle\Entity\Touchpointallocations;
use MissionControl\Bundle\ProjectBundle\Entity\Results;
use MissionControl\Bundle\ProjectBundle\Entity\Individualperformances;


use FOS\RestBundle\Controller\FOSRestController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use FOS\RestBundle\Controller\Annotations\View;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;
use \Symfony\Component\HttpKernel\Exception\HttpException;
use Rhumsaa\Uuid\Uuid;
use Rhumsaa\Uuid\Exception\UnsatisfiedDependencyException;
use Nelmio\ApiDocBundle\Annotation\ApiDoc;
use Symfony\Component\HttpFoundation\File\File;
use JMS\Serializer\SerializationContext;

class ProjectController extends FOSRestController {

    /**
     * @ApiDoc(
     *    resource = true,
     *    description = "Returns an array of projects for the authenticated user",
     *    statusCodes = {
     *     200 = "Returned when the request is without errors",
     *     403 = "Returned when user API KEY is not valid.",
     *     500 = "Returned when no token was found in header"
     *    },
     *    requirements = {
     *      {
     *          "name" = "_format",
     *          "requirement" = "json|xml"
     *      }
     *    }
     * )
     * @return array
     * @View()
     */
    public function getProjectsAction() {
        $user = $this->getUser();

        // Return projects array
        return ['projects' => $user->getProjects()];
    }

    /**
     * @ApiDoc(
     *    resource = true,
     *    description = "Returns a project based on [projectId]",
     *    statusCodes = {
     *     200 = "Returned when the project was found",
     *     403 = "Returned when user API KEY is not valid.",
     *     404 = {
     *         "Returned When the project was not found in database",
     *         "Returned when the user does not have access to the project"
     *     },
     *     500 = "Returned when no token was found in header"
     *    },
     *    requirements = {
     *       {
     *           "name"="projectId",
     *           "dataType"="string",
     *           "description"="The project unique id"
     *       },
     *       {
     *          "name" = "_format",
     *          "requirement" = "json|xml"
     *       }
     *    }
     * )
     * @return array
     * @View()
     */
    public function getProjectAction($projectId) {
        $user = $this->getUser();

        $project = $this->getDoctrine()->getRepository('ProjectBundle:Project')
                ->findBy(['user' => $user, 'id' => $projectId]);

        if (!$project) {
            $response = new Response();
            // Set response data:
            $response->setStatusCode(404);
            $response->setContent(json_encode(array(
                'Status' => 'Requested project is not available in our database.'
                    ))
            );
            return $response;
        }

        // Serialize the Project instance to return JSON format:
        $serializer = $this->get('jms_serializer');
        $jsonContent = $serializer->serialize($project, 'json', SerializationContext::create()->setGroups(array('projectInfo')));

        return ['project' => $project];
    }

    /**
     * This method retrieves the XML file of a project.
     */
    public function getXmlFileAction($projectId) {

        // Retrieve Project instance for the XML file:
        $project = $this->getDoctrine()->getRepository('ProjectBundle:Project')
                ->findOneById($projectId);

        // Set filee to be returned to client:
        $file = new File($project->xmlFilePath);
        $response = new Response(file_get_contents($file));

        // Set a Content-Disposition ehader for the file:
        $disposition = $response->headers->makeDisposition(ResponseHeaderBag::DISPOSITION_ATTACHMENT, $project->name);
        $response->headers->set('Content-Disposition', $disposition);

        return $response;
    }

// End of getXmlFileAction() method.

    /**
     * @ApiDoc(
     *    resource = true,
     *    description = "Insert a new project in the database",
     *    statusCodes = {
     *     201 = "Returned when the project was added to the database",
     *     400 = "Returned when the validation returns false ",
     *     403 = "Returned when user API KEY is not valid.",
     *     500 = "Returned when no token was found in header"
     *    },
     *    requirements = {
     *       {
     *           "name"="name",
     *           "dataType"="string",
     *           "description"="The project name"
     *       },
     *       {
     *           "name"="xmlFile",
     *           "dataType"="file",
     *           "description"="The project XML file."
     *       },
     *       {
     *          "name" = "_format",
     *          "requirement" = "json|xml"
     *       }
     *    }
     * )
     * return string
     * @View()
     */
    public function postProjectAction(Request $request) {

        $user = $this->getUser();

        $key = Uuid::uuid4()->toString();

        // Populate the Project object with data from the Request:
        $project = new Project();
        // 1 Level 1
       
        $lightproject = new Lightxmlprojects();
        
            // 2 Level 2
            $setup              = new Setups();
            $objectives         = new Objectives();
            $touchpoints        = new Touchpoints();
            $cprattributes      = new Cprattributes();
            $budgetallocation   = new Budgetallocations();
            $timeallocation     = new Timeallocations();
            
                // 3 Level 3
                $client                     = new Clients();
                $survey                     = new Surveys();
                $target                     = new Targets();
                $objectivescores            = new Objectivescores();
                $attributescores            = new Attributescores();
                $total                      = new TimeTotal();
                $allocatedtouchpoints       = new Touchpointtimeallocation();
                $budgetallocatedtouchpoints = new BudgetAllocatedtouchpoints();
                $budgettotal                = new BudgetTotal();
                
                    // 4 Level 4
                    $allocationbyperiod     = new Allocations();
                    $touchpointallocations  = new Touchpointallocations();
                    
                        // 5 Level 5
                        $allocations = new Allocations();
                        
                            // 6 Level 6
                            $results                = new Results();
                            $individualperformance  = new Individualperformances();
                    
        
       
                    
        $project->setId($key);
        $project->setName($request->get('name'));

        $project->setXmlFile($request->files->get('xmlFile'));
        ////////////////////////////////////////////////
        // pbc_xmlfile contains the uploaded xml file.
        ////////////////////////////////////////////////
        $pbc_xmlfile = $request->files->get('xmlFile');
        $xml_file_data = simplexml_load_file($pbc_xmlfile);
        
        
// setting level 2 data of the lightproject
          $lightproject->setProjectUniqueId($project->getId());
          //$lightproject->setSetup($setup);
          $lightproject->setObjectives($objectives);
          $lightproject->setTouchpoints($touchpoints);
          $lightproject->setCprattributes($cprattributes);
          $lightproject->setBudgetallocation($budgetallocation);
          $lightproject->setTimeallocation($timeallocation);
        

        // setting level 3 data of the lightproject 
        
       
        ////////////////////////////////////////////////////////////////
        //Assign Project SETUP Data
        ////////////////////////////////////////////////////////////////
        $client->setName($xml_file_data->Setup->Client->Name);
        $client->setDbid($xml_file_data->Setup->Client->DbID);
             $setup->setClient($client);
             
        $target->setName($xml_file_data->Setup->Target->Name);
        $target->setDbid($xml_file_data->Setup->Target->DbID);
             $setup->setTarget($target);
       
        $survey->setName($xml_file_data->Setup->Survey->Name);
        $survey->setDbid($xml_file_data->Setup->Survey->DbID);
            $setup->setSurvey($survey);
            
            
            $datetime = new \DateTime($xml_file_data->Setup->StartDate);
            //$datetime = $xml_file_data->Setup->StartDate;
            $setup->setStartdate($datetime);
            
           // $setup->setStartdate($xml_file_data->Setup->StartDate);
            $setup->setPeriodtype($xml_file_data->Setup->PeriodType);
            $setup->setNbperiods($xml_file_data->Setup->NbPeriods);
            $setup->setBudget($xml_file_data->Setup->Budget);
            $setup->setBudgetcurrency($xml_file_data->Setup->BudgetCurrency);
            
        ////////////////////////////////////////////////////////////////
        ////////////////////////////////////////////////////////////////
         $lightproject->setSetup($setup);
        ////////////////////////////////////////////////////////////////
        ////////////////////////////////////////////////////////////////
               
                
                      
            
        ////////////////////////////////////////////////////////////////    
        //Assign Project OBJECTIVES Data 
        ////////////////////////////////////////////////////////////////
            
        $objectives_array_from_file = $xml_file_data->Objectives->Objective;
        $number_of_objectives_from_file = count($objectives_array_from_file);
        
        for ($i=0;$i<$number_of_objectives_from_file;$i++) {
             $obiectiv = new Objectives();
             $obiectiv->setProjectId($lightproject->getProjectUniqueId());
             $obiectiv->setHtmlcolor($xml_file_data->Objectives->Objective[$i]->HtmlColor);
             $obiectiv->setName($xml_file_data->Objectives->Objective[$i]->Name);
             $obiectiv->setScore($xml_file_data->Objectives->Objective[$i]->Score);
             $obiectiv->setSelected($xml_file_data->Objectives->Objective[$i]->Selected);
             //!!!PERSIST HERE. // Must/should add some validation !!!
             $em_test = $this->getDoctrine()->getManager();
             $em_test->persist($obiectiv);
             $em_test->flush();
        }
        $lightproject->setObjectives($obiectiv);
        
        
        ////////////////////////////////////////////////////////////////    
        //Assign Project TOUCHPOINTS Data 
        ////////////////////////////////////////////////////////////////
        
        
        $touchpoints_array_from_file = $xml_file_data->Touchpoints->Touchpoint;
        $number_of_touchpoints = count($touchpoints_array_from_file);
        //print_r($number_of_touchpoints);
        
       for ($i=0;$i<$number_of_touchpoints;$i++) {
             $touchpoint[$i] = new Touchpoints();
             
             $touchpoint[$i]->setProjectId($lightproject->getProjectUniqueId());
             //Add column for project id to touchpoints.
                //$touchpoint[$i]->setProjectId($project->getId());
             $touchpoint[$i]->setName($xml_file_data->Touchpoints->Touchpoint[$i]->Name);
             $touchpoint[$i]->setLocalname($xml_file_data->Touchpoints->Touchpoint[$i]->LocalName);
             $touchpoint[$i]->setHtmlcolor($xml_file_data->Touchpoints->Touchpoint[$i]->HtmlColor);
             $touchpoint[$i]->setSelected($xml_file_data->Touchpoints->Touchpoint[$i]->Selected);
             //$touchpoint[$i]->set
             // Count how many objective scores and attributescores a touchpoint has.
                //?? Is this counting for each or only for the first touchpoint ?? //
             $objectivescores_number = count($touchpoints_array_from_file->ObjectiveScores->double);
             $attributescores_number = count($touchpoints_array_from_file->AttributeScores->double);
             
             
             for ($j=0;$j<$objectivescores_number;$j++){
                 
                 
                 $objectivescore[$j] = new Objectivescores();
                
                 $objectivescore[$j]->setTouchpointId('123456');
                 $objectivescore[$j]->setObjectivescoreValue($touchpoints_array_from_file->ObjectiveScores->double[$j]->__toString());
              
                         
                 $touchpoint[$i]->setObjectivescores($objectivescore[$j]);

                 //print_r($touchpoint[$i]);
                 //$em_test2 = $this->getDoctrine()->getManager();
                 //$em_test2->persist($touchpoint[$i]);
                 //$em_test2->flush();
             }
             
             ///print_r($objectivescore[0]);
             
//             foreach ($touchpoints_array_from_file->ObjectiveScores as $individual_objectivescore){
//                 
//                 
//                 $objectivescore->setObjectivescoreValue('3');
//                 
//                 
//// THIS IS TOUCHPOINTS -> OBJECTIVESCORES;
//                 var_dump($individual_objectivescore->double->__toString());
//                 
//                 //print_r(count($individual_objectivescore));
//                 //print_r($individual_touchpoint->ObjectiveScores->double);
//                 //print_r($individual_touchpoint->AttributeScores->double);
//             }
             
             //die();
             
             ///
             
             
             
             
             
             //$touchpoint[$i]->setObjectivescores(new Objectivescores());  // Here should be something ... unique ? :| Like PROJECT ID + Touchpoint ID ?!?!?!
             //$touchpoint[$i]->setAttributescores(new Attributescores());
           
             
             
             // TRY TO PERSIST HERE.
             //$em_test = $this->getDoctrine()->getManager();
//             $em_test->persist($touchpoint[$i]);
             //$em_test->flush();
//             print_r($touchpoint[$i]);
             //print_r($touchpoints_array_from_file);
        }
        //print_r($objectives);
        //print_r($objectivescores_number);
        
        
        ////////////////////////////////////////////////////////////////
        ////////////////////////////////////////////////////////////////
        
        ////////////////////////////////////////////////////////////////    
        //Assign Project INDIVIDUALPERFORMANCE Data 
        ////////////////////////////////////////////////////////////////
        
        //$individualperformance_array = $xml_file_data->TimeAllocation->Total->AllocationByPeriod->AllocationData->Result->IndividualPerformance;
        
        //print_r($individualperformance_array);
        
         ////////////////////////////////////////////////////////////////
        ////////////////////////////////////////////////////////////////
//        foreach ($xml_file_data->children() as $second) {
//            echo '2 ------------------------------';
//            echo $second->getName();
//                     
//            foreach ($second->children() as $third) {
//                //print_r('3...');
//                print_r($third->getName().'=='.$third->__toString());
//                
//                foreach ($third->children() as $fourth) {
//                    echo '<br />4...........'.$fourth->getName();
//                    
//                    foreach ($fourth->children() as $fifth) {
//                        echo '<br /> 5 ...........................'.$fifth->__toString();
//                        
//                    }
//                }
//            }
//            //print_r($second->children()->getName());
//        }
        
        
        //print_r($xml_file_data->children());
        //die();
            
    
                           
        $project->setUser($user);

        // Get validator service to check for errors:
        $validator = $this->get('validator');
        $errors = $validator->validate($project);
        
        // Create and prepare the Response object to be sent back to client:
        $response = new Response();

        if (count($errors) > 0) {

            // Return $errors in JSON format:
            $view = $this->view($errors, 400);
            return $this->handleView($view);
        }

                                                                       
        // If no errors were found, persist the Project to the database
        $em = $this->getDoctrine()->getManager();

        // Move the file in the uploads folder before persisting the Project entity:
        //$project->upload();

        $em->persist($lightproject);
        //$em->persist($client);
        //$em->persist($timeallocation);
//        $em->persist($setup);
        $em->flush();

        $response->setStatusCode(201);
        $response->setContent(json_encode(array(
            'Status' => 'Project has been added to the database.'
                ))
        );

        return $response;
    }

    /**
     * @ApiDoc(
     *    resource = true,
     *    description = "Update a project based on [projectId]",
     *    statusCodes = {
     *     201 = "Returned when the project was updated.",
     *     400 = {
     *      "Returned when the validation returns false.",
     *      "Returned when the name and xml is empty.",
     *      "Returned when the user does not have access to the project."
     *     },
     *     403 = "Returned when user API KEY is not valid.",
     *     500 = "Returned when no token was found in header."
     *    },
     *    requirements = {
     *       {
     *           "name"="projectId",
     *           "dataType"="string",
     *           "description"="The project unique id"
     *       },
     *       {
     *           "name"="name",
     *           "dataType"="string",
     *           "description"="The project name"
     *       },
     *       {
     *           "name"="xml",
     *           "dataType"="text",
     *           "description"="The project xml data"
     *       },
     *       {
     *          "name" = "_format",
     *          "requirement" = "json|xml"
     *       }
     *    }
     * )
     * @return array
     * @View()
     */
    public function putProjectAction($projectId, Request $request) {
        $user = $this->getUser();

        $response = new Response();

        // Return response error if the project id is empty
        if ($projectId == NULL) {
            $response->setStatusCode(400);
            $response->setContent('The project id cannot be empty.');

            return $response;
        }

        // Check if the current user has access to the content
        $project = $this->getDoctrine()->getRepository('ProjectBundle:Project')
                ->findOneBy(['user' => $user, 'id' => $projectId]);

        // Check if the project exists
        if (!$project) {
            $response = new Response();
            // Set response data:
            $response->setStatusCode(404);
            $response->setContent(json_encode(array(
                'Status' => 'Requested project is not available in our database.'
                    ))
            );
            return $response;
        }

        $name = $request->get('name');
        $xml = $request->get('xml');

        $params = FALSE;

        if ($name != NULL) {
            $project->setName($name);

            $params = TRUE;
        }

        if ($xml != NULL) {
            $project->setXml($xml);

            $params = TRUE;
        }


        if ($params === TRUE) {

            // Get validator service to check for errors:
            $validator = $this->get('validator');
            $errors = $validator->validate($project);

            if (count($errors) > 0) {

                $serializer->serialize($errors, 'json');

                // Set response data:
                $response->setStatusCode(400);
                $response->setContent($errors);
                return $response;
            }

            $em = $this->getDoctrine()->getManager();
            $em->persist($project);
            $em->flush();

            $response->setStatusCode(201);
            $response->setContent(json_encode(array(
                'status' => 'Project was successfully updated.'
                    ))
            );

            return $response;
        }

        $response->setStatusCode(400);
        $response->setContent(json_encode(array(
            'Status' => 'Project name or xml needs to be added.'
                ))
        );

        return $response;
    }

    /**
     * @ApiDoc(
     *    resource = true,
     *    description = "Delete a project based on [projectId]",
     *    statusCodes = {
     *     200 = "Returned when the project was deleted with success",
     *     400 = {
     *         "Returned When the project was not found in database",
     *         "Returned when the user does not have access to the project"
     *     },
     *     403 = "Returned when user API KEY is not valid.",
     *     500 = "Returned when no token was found in header"
     *    },
     *    requirements = {
     *       {
     *           "name"="projectId",
     *           "dataType"="string",
     *           "description"="The project unique id"
     *       },
     *       {
     *          "name" = "_format",
     *          "requirement" = "json|xml"
     *       }
     *    }
     * )
     * @return array
     * @View()
     */
    public function deleteProjectAction($projectId) {
        $user = $this->getUser();
        $response = new Response();

        if ($projectId == NULL) {
            $response->setStatusCode(400);
            $response->setContent('The id parameter cannot be null.');
        }

        $project = $this->getDoctrine()->getRepository('ProjectBundle:Project')
                ->findOneBy(['user' => $user, 'id' => $projectId]);

        $em = $this->getDoctrine()->getManager();

        if (empty($project)) {
            $response = new Response();
            $response->setStatusCode(400);
            $response->setContent(json_encode(array(
                'Status' => 'Requested project is not available in our database.'
                    ))
            );
            return $response;
        }

        $em->remove($project);
        $em->flush();

        $response->setStatusCode(200);
        $response->setContent(json_encode(array(
            'Status' => 'Project has been deleted.'
                ))
        );

        return $response;
    }

}
