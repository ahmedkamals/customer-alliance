<?php

namespace AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Generator\UrlGeneratorInterface;

/**
 * Class WidgetController
 * @package AppBundle\Controller
 */
class WidgetController extends Controller
{
    /**
     * @param string  $uuid
     *
     * @return Response
     */
    public function scriptAction(string $uuid)
    {
        $content = $this->render('widget/script.js',
            [
                'url' => $this->generateUrl(
                    'iframe_action',
                    ['uuid' => $uuid],
                    UrlGeneratorInterface::ABSOLUTE_URL
                ),
            ]
        )->getContent();

        return new Response($content, Response::HTTP_OK, ['Content-Type' => 'application/javascript']);
    }

    /**
     * @param string $uuid
     *
     * @return Response
     */
    public function iframeAction(string $uuid)
    {
        return $this->render('widget/iframe.html.twig',
            [
                'uuid' => $uuid,
                'rating' => sprintf('%d%%', 59),
            ]
        );
    }
}