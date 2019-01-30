<?php
/**
 * Copyright © Vaimo Group. All rights reserved.
 * See LICENSE_VAIMO.txt for license details.
 */
namespace Vaimo\ComposerChangelogs\Resolvers;

use Composer\Repository\WritableRepositoryInterface;

class PluginPackageResolver
{
    /**
     * @var \Composer\Package\PackageInterface[]
     */
    private $additionalPackages;
    
    /**
     * @var \Vaimo\ComposerChangelogs\Analysers\PackageAnalyser
     */
    private $packageAnalyser;

    /**
     * @param \Composer\Package\PackageInterface[] $additionalPackages
     */
    public function __construct(
        array $additionalPackages = []
    ) {
        $this->additionalPackages = $additionalPackages;

        $this->packageAnalyser = new \Vaimo\ComposerChangelogs\Analysers\PackageAnalyser();
    }

    /**
     * @param WritableRepositoryInterface $repository
     * @param string $namespace
     * @return \Composer\Package\PackageInterface
     * @throws \Exception
     */
    public function resolveForNamespace(WritableRepositoryInterface $repository, $namespace)
    {
        $packages = array_merge(
            $this->additionalPackages, 
            $repository->getCanonicalPackages()
        );
        
        foreach ($packages as $package) {
            if (!$this->packageAnalyser->isPluginPackage($package)) {
                continue;
            }

            if (!$this->packageAnalyser->ownsNamespace($package, $namespace)) {
                continue;
            }

            return $package;
        }

        throw new \Vaimo\ComposerChangelogs\Exceptions\PackageResolverException(
            'Failed to detect the plugin package'
        );
    }
}
