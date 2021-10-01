<?php

namespace StageBundle\Controller;

use StageBundle\Entity\indexe;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Unirest;

class DefaultController extends Controller
{
    public function indexAction()
    {
        return $this->render('@Stage/Default/index.html.twig');
    }


// search Songs of Frank Sinatra
    public function testAPiAction($id,$page=1)
    {

   $size=20;
    $from=($page*20)-20;

        $indexe=$this->getDoctrine()->getManager()->getRepository(indexe::class)->find($id);
        $server=$indexe->getServer();
        $url=$server->getUrl().":".$server->getPort().'/'.$indexe->getLibelle().'/_search?size='.$size.'&from='.$from;



        $username=$server->getUsername();
        $pwd=$server->getMdp();
        Unirest\Request::auth($username,$pwd,CURLAUTH_BASIC);

        $headers = array('Accept' => 'application/json');


        $response = Unirest\Request::get($url, $headers);


// or use a plain text request
// $response = Unirest\Request::get('https://api.spotify.com/v1/search?q=Frank%20sinatra&type=track');

// Display the result
        $nbrPAge=$response->body->hits->total->value/20;
        return $this->render('@Stage/produit/afficheP.html.twig', array(
            'produits' => $response->body->hits->hits,
            'nbrPAge'=>$nbrPAge,
            'indexe'=>$indexe,
            'page'=>$page
        ));
    }
    public function testAPiSearchAction($id,$page=1,$word="")
    {

        $size=20;
        $from=($page*20)-20;

        $indexe=$this->getDoctrine()->getManager()->getRepository(indexe::class)->find($id);
        $server=$indexe->getServer();
        $url=$server->getUrl().":".$server->getPort().'/'.$indexe->getLibelle().'/_search?size='.$size.'&from='.$from;



        $username=$server->getUsername();
        $pwd=$server->getMdp();
        Unirest\Request::auth($username,$pwd,CURLAUTH_BASIC);
        $cdts=array();
        $headers = array('Accept' => 'application/json','Content-Type'=> 'application/json');
        array_push($cdts, array('match'=>array("titleN"=>array("query"=>$word))));
        $body =  array('query' => array('constant_score'=> array('filter'=> array('bool' => array('must' => $cdts)))));
        $params =  Unirest\Request\Body::json($body);
//var_dump($params);
        $response = Unirest\Request::Post($url, $headers,$params);

       // var_dump($response) ;
// or use a plain text request
// $response = Unirest\Request::get('https://api.spotify.com/v1/search?q=Frank%20sinatra&type=track');

// Display the result
        $nbrPAge=$response->body->hits->total->value/20;
        return $this->render('@Stage/produit/searchP.html.twig', array(
            'produits' => $response->body->hits->hits,
            'nbrPAge'=>$nbrPAge,
            'indexe'=>$indexe,
            'page'=>$page,
            'word'=>$word
        ));
    }

    public function searchPosetAction($id,$page=1,Request $request){

        $word=$request->get('search');
       return $this->redirectToRoute('testSearch', ['id'=>$id,'page'=>$page,'word'=>$word]);
    }


//"term": {
//"status": "active"
//}


//"exists": {
//"field": "user"
//}
    public function ReglesAction($id,$page=1){
        $size=20;
        $from=($page*20)-20;
        $indexe=$this->getDoctrine()->getManager()->getRepository(indexe::class)->find($id);
        $server=$indexe->getServer();
        $url=$server->getUrl().":".$server->getPort().'/'.$indexe->getLibelle().'/_search?size='.$size.'&from='.$from;
        $username=$server->getUsername();
        $pwd=$server->getMdp();
        Unirest\Request::auth($username,$pwd,CURLAUTH_BASIC);
        $cdts=array();
        #  array_push($cdts, array('match'=>array("titleN"=>array("query"=>$word))));
        array_push($cdts, array('term'=>array("fpoids"=>array("value"=>"0"))));
         array_push($cdts, array('exists'=>array("field"=>"fpoids")));
        #array_push($cdts, array('properties'=>array("fpoids"=>array("type"=>"numeric"))));

        $headers = array('Accept' => 'application/json','Content-Type'=> 'application/json');
        $body =  array('query' => array('constant_score'=> array('filter'=> array('bool' => array('must' => $cdts)))));
        $params =  Unirest\Request\Body::json($body);
//var_dump($params);
        $response = Unirest\Request::Post($url, $headers,$params);
var_dump($response);
        $nbrPAge=$response->body->hits->total->value/20;





        return $this->render('@Stage/produit/errone.html.twig' ,array(
            'produits' => $response->body->hits->hits,
            'nbrPAge'=>$nbrPAge,
            'indexe'=>$indexe,
            'page'=>$page
        ));

    }

}