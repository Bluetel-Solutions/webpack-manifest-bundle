<?php
namespace Bluetel\WebpackManifestBundle;

use Throwable;

class WebpackManifest
{
    /**
     * @var string
     */
    private $manifestPath;

    /**
     * @var string
     */
    private $outputPath;

    /**
     * @var string
     */
    private $publicPath;

    /**
     * @param $manifestPath
     * @param $outputPath
     * @param $publicPath
     */
    public function __construct(
        $manifestPath,
        $outputPath,
        $publicPath
    ) {
        $this->manifestPath = $manifestPath;
        $this->outputPath = $outputPath;
        $this->publicPath = $publicPath;
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

    /**
     * @param string $assetFilename
     * @return string
     */
    public function getRealAssetPath(string $assetFilename)
    {
        $path = $this->getAssetPath($assetFilename);
        return str_replace($this->publicPath, $this->outputPath, $path);
    }

    /**
     * @param string $assetFilename
     * @return string
     */
    public function getAssetContents(string $assetFilename)
    {
        return file_get_contents($this->getRealAssetPath($assetFilename));
    }
}
