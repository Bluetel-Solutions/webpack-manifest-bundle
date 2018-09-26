<?php
namespace Bluetel\WebpackManifestBundle;

class WebpackManifest
{
    /**
     * @param $manifestPath
     */
    private $manifestPath;

    /**
     * @param $manifestPath
     */
    public function __construct($manifestPath)
    {
        $this->manifestPath = $manifestPath;
    }

    /**
     * @param string $assetFilename
     * @return string
     */
    public function getAssetPath(string $assetFilename)
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
