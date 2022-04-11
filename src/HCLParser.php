<?php

namespace DivineOmega\HCLParser;

/**
 * Class HCLParser.
 */
class HCLParser
{
    /**
     * @var
     */
    private $hcl;

    /**
     * HCLParser constructor.
     *
     * @param $hcl
     */
    public function __construct($hcl)
    {
        $this->hcl = $hcl;
    }

    /**
     * @return string
     */
    private function getBinaryPath()
    {
        $binaryPath = __DIR__.'/../bin/'.Installer::getBinaryFilename();

        if (!file_exists($binaryPath)) {
            Installer::installBinaries();
        }

        return $binaryPath;
    }

    /**
     * @return string
     */
    private function getJSONString()
    {
        $command = $this->getBinaryPath().' --reverse < ' . $this->hcl;
        exec($command, $lines);

        return implode(PHP_EOL, $lines);
    }

    /**
     * @return mixed
     */
    public function parse()
    {
        return json_decode($this->getJSONString());
    }
}
