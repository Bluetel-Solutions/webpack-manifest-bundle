<?php
namespace Bluetel\WebpackManifestBundle\Twig;

use Bluetel\WebpackManifestBundle\WebpackManifest;
use Twig_Extension;
use Twig_Function;

class WebpackManifestExtension extends Twig_Extension
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
     * @return Twig_Function[]
     */
    public function getFunctions()
    {
        return array(new Twig_Function('webpack_manifest_asset', array($this, 'manifestAsset')));
    }

    /**
     * @param string $assetFilename
     * @return string
     */
    public function manifestAsset(string $assetFilename)
    {
        return $this->webpackManifest->getAssetPath($assetFilename);
    }
}
