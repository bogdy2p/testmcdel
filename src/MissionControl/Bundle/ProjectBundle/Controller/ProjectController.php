<?php

namespace MissionControl\Bundle\ProjectBundle\Controller;

use MissionControl\Bundle\ProjectBundle\Entity\Project;
use MissionControl\Bundle\ProjectBundle\Entity\Lightxmlprojects;
use MissionControl\Bundle\ProjectBundle\Entity\Setups;
use MissionControl\Bundle\ProjectBundle\Entity\Objectives;
use MissionControl\Bundle\ProjectBundle\Entity\Touchpoints;
use MissionControl\Bundle\ProjectBundle\Entity\Cprattributes;
//use MissionControl\Bundle\ProjectBundle\Entity\Budgetallocations;
use MissionControl\Bundle\ProjectBundle\Entity\Timeallocations;
use MissionControl\Bundle\ProjectBundle\Entity\Clients;
use MissionControl\Bundle\ProjectBundle\Entity\Surveys;
use MissionControl\Bundle\ProjectBundle\Entity\Targets;
use MissionControl\Bundle\ProjectBundle\Entity\Objectivescores;
use MissionControl\Bundle\ProjectBundle\Entity\Attributescores;
use MissionControl\Bundle\ProjectBundle\Entity\BudgetAllocationData;
use MissionControl\Bundle\ProjectBundle\Entity\TimeAllocationData;
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
        
        $lightxmldata = $this->getDoctrine()->getRepository('ProjectBundle:Lightxmlprojects')
                    ->findBy(['projectUniqueId' => $projectId]);
        
        if (!$lightxmldata){
            $response = new Response();
            $response->setStatusCode(418);
            $response->setContent(json_encode(array('Status'=> ' bleah ... n-avem !')));
            return $response;
        }
        
        //print_r($lightxmldata);
        //exit(\Doctrine\Common\Util\Debug::dump($lightxmldata));
        //die();

        $project_unique_identifier = $lightxmldata[0]->getProjectUniqueId();
        
        $objectives = $this->getDoctrine()->getRepository('ProjectBundle:Objectives')
                    ->findBy(['projectId'=> $project_unique_identifier]);
                  
        
        
        // Serialize the Project instance to return JSON format:
        $serializer = $this->get('jms_serializer');
        $jsonContent = $serializer->serialize($project, 'json', SerializationContext::create()->setGroups(array('projectInfo')));

        return ['project' => $project
                ,'lightxmldata' => $lightxmldata,
                'objectives' => $objectives
            ];
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

        $project->setId($key);
        $project->setName($request->get('name'));
        $project->setXmlFile($request->files->get('xmlFile'));
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
        
        // If no errors were found, instantiate entity_manager to begin.
        $em = $this->getDoctrine()->getManager();
        
        $lightproject = new Lightxmlprojects();
        $setup = new Setups();
        $client = new Clients();
        $survey = new Surveys();
        $target = new Targets();
        
        ////////////////////////////////////////////////
        // pbc_xmlfile contains the uploaded xml file.
        ////////////////////////////////////////////////
        $pbc_xmlfile = $request->files->get('xmlFile');
        $xml_file_data = simplexml_load_file($pbc_xmlfile);

   
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
        $setup->setStartdate($datetime);
        $setup->setPeriodtype($xml_file_data->Setup->PeriodType);
        $setup->setNbperiods($xml_file_data->Setup->NbPeriods);
        $setup->setBudget($xml_file_data->Setup->Budget);
        $setup->setBudgetcurrency($xml_file_data->Setup->BudgetCurrency);

        ////////////////////////////////////////////////////////////////
        ////////////////////////////////////////////////////////////////
        $lightproject->setProjectUniqueId($project->getId());
        $lightproject->setSetup($setup);
        
        ////////////////////////////////////////////////////////////////
        ////////////////////////////////////////////////////////////////
        ////////////////////////////////////////////////////////////////    
        //Assign and persist Project OBJECTIVES Data 
        ////////////////////////////////////////////////////////////////


        $objectives_array_from_file = $xml_file_data->Objectives->Objective;

        foreach ($objectives_array_from_file as $objective) {
            $objective_object = new Objectives();
            $objective_object->setProjectId($lightproject->getProjectUniqueId());
            $objective_object->setName($objective->Name);
            $objective_object->setHtmlcolor($objective->HtmlColor);
            $objective_object->setScore($objective->Score);
            $objective_object->setSelected($objective->Selected);
            //print_r($objective_object);
            $em->persist($objective_object);
        }
        ////////////////////////////////////////////////////////////////
        ////////////////////////////////////////////////////////////////
        ////////////////////////////////////////////////////////////////    
        //Assign and persist Project TOUCHPOINTS Data 
        ////////////////////////////////////////////////////////////////

        $touchpoints_array_from_file = $xml_file_data->Touchpoints->Touchpoint;
        foreach ($touchpoints_array_from_file as $touchpoint) {

            $touchpoint_object = new Touchpoints();
            $touchpoint_object->setProjectId($key);
            $touchpoint_object->setName($touchpoint->Name);
            $touchpoint_object->setLocalname($touchpoint->LocalName);
            $touchpoint_object->setHtmlcolor($touchpoint->HtmlColor);
            $touchpoint_object->setSelected($touchpoint->Selected);
            $em->persist($touchpoint_object);
            $em->flush();
            // Iterate over Objectivescores 
            
            $objectivescores_double = $touchpoint->ObjectiveScores->double;
            foreach ($objectivescores_double as $objectivescore) {

                $objectivescore_object = new Objectivescores();
                $objectivescore_object->setTouchpointId($touchpoint_object->getTouchpointId());
                $objectivescore_object->setObjectivescoreValue($objectivescore->__toString());
                $em->persist($objectivescore_object);
            }

            // Iterate over AttributeScores 
            $attributescores_double = $touchpoint->AttributeScores->double;
            foreach ($attributescores_double as $attributescore) {
                $attributescore_object = new Attributescores();
                $attributescore_object->setTouchpointId($touchpoint_object->getTouchpointId());
                $attributescore_object->setAttributescoreValue($attributescore->__toString());
                $em->persist($attributescore_object);
            }
        }
        ////////////////////////////////////////////////////////////////
        ////////////////////////////////////////////////////////////////
        ////////////////////////////////////////////////////////////////    
        //Assign and persist Project CPRAttributes Data 
        ////////////////////////////////////////////////////////////////


        $cprattributes_array_from_file = $xml_file_data->CPRAttributes->CPRAttribute;
        foreach ($cprattributes_array_from_file as $cprattribute) {
            $cprattribute_object = new Cprattributes();

            $cprattribute_object->setProjectID($lightproject->getProjectUniqueId());
            $cprattribute_object->setName($cprattribute->Name);
            $cprattribute_object->setDescription($cprattribute->Description);
            $cprattribute_object->setSelected($cprattribute->Selected);
            $em->persist($cprattribute_object);
        }

        ////////////////////////////////////////////////////////////////
        ////////////////////////////////////////////////////////////////
        ////////////////////////////////////////////////////////////////
        ////////////////////////////////////////////////////////////////
        ////////////////////////////////////////////////////////////////    
        ////Assign and persist Project BUDGETALLOCATION Data 
        ////Assign and persist Project BUDGETALLOCATION Data 
        ////Assign and persist Project BUDGETALLOCATION Data 
        ////////////////////////////////////////////////////////////////   
        ////////////////////////////////////////////////////////////////
        ////////////////////////////////////////////////////////////////

        $budgetallocation = $xml_file_data->BudgetAllocation;
        $budgetallocatedtouchpoints = $budgetallocation->AllocatedTouchpoints->TouchpointAllocation;
        $budgettotal = $budgetallocation->Total;

        foreach ($budgetallocatedtouchpoints as $budget_allocated_touchpoint) {
            $budget_allocation = new BudgetAllocationData();
            $budget_allocation->setIsTotal(false);
            $budget_allocation->setBelongsToProject($lightproject->getProjectUniqueId());
            $budget_allocation->setTouchpointName($budget_allocated_touchpoint->TouchpointName->__toString());
            $budget_allocation->setGrp($budget_allocated_touchpoint->Allocation->GRP->__toString());
            $budget_allocation->setCostpergrp($budget_allocated_touchpoint->Allocation->CostPerGRP->__toString());
            $budget_allocation->setGlobalPerformance($budget_allocated_touchpoint->Allocation->Result->GlobalPerformance->__toString());
            $budget_allocation->setReach($budget_allocated_touchpoint->Allocation->Result->Reach->__toString());
           
            $individualperformancesarray = $budget_allocated_touchpoint->Allocation->Result->IndividualPerformance->double;
            $variable_to_save = '';
            foreach ($individualperformancesarray as $indiv_perf) {
                $variable_to_save = $variable_to_save . $indiv_perf->__toString() . " ";
            }
            $budget_allocation->setIndividualPerformances($variable_to_save);
            $em->persist($budget_allocation);
        }


        $budget_total = new BudgetAllocationData();
        $budget_total->setBelongsToProject($lightproject->getProjectUniqueId());
        $budget_total->setIsTotal(true);
        $budget_total->setTouchpointName($budgettotal->TouchpointName->__toString());
        $budget_total->setGrp($budgettotal->Allocation->GRP->__toString());
        $budget_total->setCostpergrp($budgettotal->Allocation->CostPerGRP->__toString());
        $budget_total->setGlobalPerformance($budgettotal->Allocation->Result->GlobalPerformance->__toString());
        $budget_total->setReach($budgettotal->Allocation->Result->Reach->__toString());
       
        $individualperformancesarray = $budgettotal->Allocation->Result->IndividualPerformance->double;
        $variable_to_save = '';
        foreach ($individualperformancesarray as $indiv_perf) {
            $variable_to_save = $variable_to_save . $indiv_perf->__toString() . " ";
        }

        $budget_total->setIndividualPerformances($variable_to_save);
        $em->persist($budget_total);

        ////////////////////////////////////////////////////////////////   
        ////////////////////////////////////////////////////////////////
        ////////////////////////////////////////////////////////////////
        ////////////////////////////////////////////////////////////////
        ////////////////////////////////////////////////////////////////
        ////////////////////////////////////////////////////////////////
        ////////////////////////////////////////////////////////////////
        ////////////////////////////////////////////////////////////////    
        ////Assign and persist Project TIME ALLOCATION Data 
        ////Assign and persist Project TIME ALLOCATION Data 
        ////Assign and persist Project TIME ALLOCATION Data 
        ////////////////////////////////////////////////////////////////   
        ////////////////////////////////////////////////////////////////
        ////////////////////////////////////////////////////////////////

        $timeallocation = $xml_file_data->TimeAllocation;

        $timeallocatedtouchpoints = $timeallocation->AllocatedTouchpoints->TouchpointTimeAllocation;
        $timetotal = $timeallocation->Total;

        $time_total = new TimeAllocationData();
        $time_total->setBelongsToProject($lightproject->getProjectUniqueId());
        $time_total->setIsTotal(true);

        $touchpoint_time_allocations = $timeallocation->AllocatedTouchpoints->TouchpointTimeAllocation;

        foreach ($touchpoint_time_allocations as $touchpoint_time_allocation) {

            foreach ($touchpoint_time_allocation->AllocationByPeriod->AllocationData as $time_allocation_data) {

                $time_allocation = new TimeAllocationData();

                $time_allocation->setBelongsToProject($key);
                $time_allocation->setTouchpointName($touchpoint_time_allocation->TouchpointName->__toString());
                $time_allocation->setReachFrequency($touchpoint_time_allocation->ReachFrequency);
                $time_allocation->setCostpergrp($time_allocation_data->CostPerGRP->__toString());
                $time_allocation->setGrp($time_allocation_data->GRP->__toString());
                $time_allocation->setGlobalPerformance($time_allocation_data->Result->GlobalPerformance->__toString());
                $time_allocation->setReach($time_allocation_data->Result->Reach->__toString());
                $time_allocation->setIsTotal(false);

                $individualperformancesarray = $time_allocation_data->Result->IndividualPerformance->double;

                $variable_to_save = '';
                foreach ($individualperformancesarray as $indiv_perf) {
                    $variable_to_save = $variable_to_save . $indiv_perf->__toString() . " ";
                }

                $time_allocation->setIndividualPerformances($variable_to_save);

                $em->persist($time_allocation);
            }
        }
        
        $total_time_allocations = $timeallocation->Total->AllocationByPeriod->AllocationData;        
        
        foreach ($total_time_allocations as $total_time_allocation_data){
                        
            $total_time_allocation = new TimeAllocationData();
            $total_time_allocation->setIsTotal(true);
            $total_time_allocation->setBelongsToProject($key);
            $total_time_allocation->setTouchpointName($timeallocation->Total->TouchpointName->__toString());
            $total_time_allocation->setReachFrequency($timeallocation->Total->ReachFrequency->__toString());
            
            $total_time_allocation->setCostpergrp($total_time_allocation_data->CostPerGRP->__toString());
            $total_time_allocation->setGrp($total_time_allocation_data->GRP->__toString());
            $total_time_allocation->setGlobalPerformance($total_time_allocation_data->Result->GlobalPerformance->__toString());
            $total_time_allocation->setReach($total_time_allocation_data->Result->Reach->__toString());
            
             $individualperformancesarray = $total_time_allocation_data->Result->IndividualPerformance->double;

                $variable_to_save = '';
                foreach ($individualperformancesarray as $indiv_perf) {
                    $variable_to_save = $variable_to_save . $indiv_perf->__toString() . " ";
                }
                $total_time_allocation->setIndividualPerformances($variable_to_save);

            $em->persist($total_time_allocation);
        }   


        

        // Move the file in the uploads folder before persisting the Project entity:
        //$project->upload();

        $em->persist($lightproject);
        $em->persist($project);
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
