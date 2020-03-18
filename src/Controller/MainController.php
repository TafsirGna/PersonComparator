<?php

namespace App\Controller;

use App\Entity\PersonComparator;
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
     * @Route("/compare", name="api_comparison_action", methods="GET")
     */
    public function comparePersonData(Request $request)
    {
        // passed data recovery
        $dbOneData = $request->get("dataOne");
        $dbTwoData = $request->get("dataTwo");

        // performing comparison
        $comparator = new PersonComparator($dbOneData, $dbTwoData);
        $output = $comparator->compare();

        // returning the comparison's output
        if ($output["success"])
            return $this->json($output, Response::HTTP_OK, []);

        return $this->json($output, Response::HTTP_BAD_REQUEST, []);
    }
}
