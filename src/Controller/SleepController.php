<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class SleepController extends AbstractController
{
    /**
     * @Route("/sleep/{seconds}", name="sleep")
     */
    public function index($seconds)
    {
        sleep($seconds);

        return $this->json([
            'message' => "I slept for '$seconds'  seconds",
            'path' => 'src/Controller/SleepController.php',
        ]);
    }
}
