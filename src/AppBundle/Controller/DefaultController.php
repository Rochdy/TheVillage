<?php

namespace AppBundle\Controller;

use Liip\ImagineBundle\Async\Commands;
use Liip\ImagineBundle\Async\Topics;
use Liip\ImagineBundle\Async\ResolveCache;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class DefaultController extends Controller
{
    /**
     * @Route("/", name="homepage")
     */
    public function indexAction(Request $request)
    {
        /**
         * @var ContainerInterface $container
         * @var ProducerInterface $producer
         */
        $producer = $this->get('enqueue.producer');
        $reply = $producer->sendCommand(Commands::RESOLVE_CACHE, new ResolveCache('poster.jpg', ['rosh'], true), true);

        $replyMessage = $reply->receive(2000); // wait for 20 sec
        dump($replyMessage);die();
    }
}
