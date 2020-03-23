<?php

namespace App\Controller;

use App\Entity\ComparisonResult;
use App\Entity\DbOnePerson;
use App\Entity\DbTwoPerson;
use App\Entity\PersonComparator;
use Doctrine\ORM\EntityManagerInterface;
use PhpParser\Node\Expr\Cast\Array_;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class MainController extends AbstractController
{
    /**
     * @Route("/main", name="main")
     */
    public function index()
    {
        return $this->json([
            'message' => 'Welcome to your new controller!',
            'path' => 'src/Controller/MainController.php',
        ]);
    }

    /**
     * @Route("/api/compare", name="api_comparison_action", methods="GET")
     */
    public function comparePersonData(Request $request, EntityManagerInterface $em)
    {
        // passed data recovery
        $dbOneData = $request->get("dataOne");
        $dbTwoData = $request->get("dataTwo");

        // performing comparison
        $comparator = new PersonComparator($dbOneData, $dbTwoData);
        $output = $comparator->compare();

        // returning the comparison's output
        if ($output["achieved"]){

            $result = [
                "firstName" => [$output["firstName"]["percentage"], $output["firstName"]["output"]],
                "lastName" => [$output["lastName"]["percentage"], $output["lastName"]["output"]],
                "birthDate" => [$output["birthDate"]["output"]],
                "birthPlace" => [$output["birthPlace"]["percentage"], $output["birthPlace"]["output"]],
                "result"    => [$output["globalOutput"]["percentage"], $output["globalOutput"]["output"]],
            ];

            $comparisonResult = new ComparisonResult((new DbOnePerson($comparator->getPersonOne())), 
                                                     (new DbTwoPerson($comparator->getPersonTwo())),
                                                     json_encode($result));

            // dd($comparisonResult);

            $em->persist($comparisonResult);
            $em->flush();

            return $this->json($output, Response::HTTP_OK, []);
        }

        return $this->json($output, Response::HTTP_BAD_REQUEST, []);
    }
}
