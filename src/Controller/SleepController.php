<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class SleepController extends AbstractController
{
    /**
     * @Route("/sleep/{seconds}/{throw}", name="sleep", format="json")
     */
    public function index($seconds, string $throw=null)
    {
        sleep($seconds);

        if (null !== $throw) {
            throw new \RuntimeException($throw);
        }

        return $this->json([
            'message' => "I slept for '$seconds'  seconds",
            'path' => 'src/Controller/SleepController.php',
        ]);
    }
}
