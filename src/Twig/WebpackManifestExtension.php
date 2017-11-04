<?php
namespace Bluetel\WebpackManifestBundle\Twig;

use Twig_Extension;
use Twig_Function;

class WebpackManifestExtension extends Twig_Extension
{
    /**
     * WebpackManifestExtension constructor.
     * @param $manifestPath
     */
    public function __construct($manifestPath)
    {
        $this->manifestPath = $manifestPath;
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
        if (!file_exists($this->manifestPath)) {
            return $assetFilename;
        }

        $manifest = json_decode(file_get_contents($this->manifestPath), true);

        if (!isset($manifest[$assetFilename])) {
            return $assetFilename;
        }

        return $manifest[$assetFilename];
    }
}
