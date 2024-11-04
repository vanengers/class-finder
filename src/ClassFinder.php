<?php

namespace Vanengers\ClassFinder;

use Symfony\Component\Finder\Finder;

class ClassFinder
{
    /**
     * @param $path
     * @return array
     * @author George van Engers <george@dewebsmid.nl>
     * @since 11-10-2023
     */
    public function getAllNameSpaces($path)
    {
        $filenames = $this->getFilenames($path);
        $namespaces = [];
        foreach ($filenames as $filename) {
            $namespaces[] = $this->getFullNamespace($filename) . '\\' . $this->getClassName($filename);
        }
        return $namespaces;
    }

    private function getClassName($filename)
    {
        $directoriesAndFilename = explode('/', $filename);
        $filename = array_pop($directoriesAndFilename);
        $nameAndExtension = explode('.', $filename);
        $className = array_shift($nameAndExtension);
        return $className;
    }

    private function getFullNamespace($filename)
    {
        $lines = file($filename);
        $array = preg_grep('/^namespace /', $lines);
        $namespaceLine = array_shift($array);
        $match = [];
        preg_match('/^namespace (.*);/', $namespaceLine, $match);
        $fullNamespace = array_pop($match);
        return $fullNamespace;
    }

    private function getFilenames($path)
    {
        $finderFiles = Finder::create()->files()->in($path)->name('*.php');
        $filenames = [];
        foreach ($finderFiles as $finderFile) {
            $filenames[] = $finderFile->getRealpath();
        }
        return $filenames;
    }
}