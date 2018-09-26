<?php
namespace Bluetel\WebpackManifestBundle\Controller;

use Bluetel\WebpackManifestBundle\WebpackManifest;
use Symfony\Component\HttpFoundation\{Request, RedirectResponse, Response};
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;

/**
 * @Route(service="webpack_manifest.controller")
 */
class WebpackManifestController
{
    /**
     * @var WebpackManifest
     */
    private $webpackManifest;

    /**
     * @param $webpackManifest
     */
    public function __construct(WebpackManifest $webpackManifest)
    {
        $this->webpackManifest = $webpackManifest;
    }

    /**
     * @Route("/__asset/{assetPath}", name="webpack_manifest_asset", requirements={"assetPath"=".+"})
     *
     * @param Request $request
     * @return Response $response
     */
    public function getAssetAction(Request $request, $assetPath)
    {
        $response = new RedirectResponse($this->webpackManifest->getAssetPath($assetPath));

        $response->setMaxAge(10);
        $response->setSharedMaxAge(3600);
        $response->headers->set('stale-if-error', 24*3600);
        $response->headers->set('stale-while-revalidate', 24*3600);

        return $response;
    }
}