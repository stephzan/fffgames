<?php

namespace App\Controller;

use App\Service\UserService;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\JsonResponse;

class AjaxController extends AbstractController
{
	private $errors;
	protected $action;
	protected $data;

    /**
     * @Route("/ajax", name="ajaxqueries", methods={"POST"})
     */
    public function index(Request $req, UserService $userRep)
    {
    	if($req->isXMLHttpRequest()){
    		if(!$this->checkQuery($req)){
    			$err = implode(" | ", $this->errors);
    			return new Response($err, 400);
    		}

    		switch($this->action){
    			case "getPlayerList":
    				return $this->getPlayerList($userRep);
    				break;
    			case "test":
    				return $this->test();
    				break;
    		}
		
        }

        return new Response("Not AJAX", 400);
    }

    public function getPlayerList(UserService $userRep){
    	$playerList = $userRep->findBy(['online'=>1], ['username'=>'ASC']);

    	$return = array();

    	foreach($playerList as $player){
    		$tmp = ["username"=>$player->getUsername()];

    		$return[] = $tmp;
    	}

    	return new JsonResponse(['data'=>$return]);
    }

    private function checkQuery(Request $req){
    	$params = json_decode($req->request->get("params"));
		if(empty($params)){
			$this->errors[] = "No parameters given";
		}

		if( (!$this->action = $params->action)|| (empty($params->action)) ){
			$this->errors[] = "No action given";
		}
		
		if( (!$this->data = $params->data)|| (empty($params->data)) ){
			$this->errors[] = "No data given";
		}

		if(!method_exists($this, $this->action)){
			$this->errors[] = "Request method does not exists";
		}

		return (!empty($this->errors)) ? false : true;		
    }

    public function test(){
    	return new JsonResponse(["data"=>"OK"]);
    }
}
