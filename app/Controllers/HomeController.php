<?php
namespace App\Controllers;




use App\Models\Test;

class HomeController extends Controller
{

    /**
     * @return mixed
     */
    public function index($request, $response)
    {

        return $this->view->render($response, 'home.twig', compact('alltest'));
    }
}