<?php
/**
 * Copyright © Vaimo Group. All rights reserved.
 * See LICENSE_VAIMO.txt for license details.
 */
namespace Vaimo\ComposerChangelogs\Generators;

use Vaimo\ComposerChangelogs\Factories;

class DocumentationGenerator
{
    /**
     * @var \Vaimo\ComposerChangelogs\Resolvers\ChangelogConfigResolver
     */
    private $configResolver;

    /**
     * @var \Vaimo\ComposerChangelogs\Loaders\ChangelogLoader
     */
    private $changelogLoader;

    /**
     * @var \Vaimo\ComposerChangelogs\Generators\Changelog\RenderContextGenerator
     */
    private $dataConverter;

    /**
     * @var \Vaimo\ComposerChangelogs\Generators\TemplateOutputGenerator
     */
    private $templateRenderer;

    /**
     * @param \Vaimo\ComposerChangelogs\Resolvers\ChangelogConfigResolver $configResolver
     */
    public function __construct(
        \Vaimo\ComposerChangelogs\Resolvers\ChangelogConfigResolver $configResolver
    ) {
        $this->configResolver = $configResolver;

        $this->changelogLoader = new \Vaimo\ComposerChangelogs\Loaders\ChangelogLoader($configResolver);

        $this->dataConverter = new \Vaimo\ComposerChangelogs\Generators\Changelog\RenderContextGenerator();
        $this->templateRenderer = new \Vaimo\ComposerChangelogs\Generators\TemplateOutputGenerator();
    }

    public function generate(\Composer\Package\PackageInterface $package)
    {
        $changelog = $this->changelogLoader->load($package);

        $outputPaths = $this->configResolver->resolveOutputTargets($package);
        $templates = $this->configResolver->resolveOutputTemplates($package);

        $contextData = $this->dataConverter->generate($changelog);

        foreach ($outputPaths as $type => $target) {
            try {
                file_put_contents(
                    $target,
                    $this->templateRenderer->generateOutput($contextData,  $templates[$type])
                );
            } catch (\Vaimo\ComposerChangelogs\Exceptions\TemplateValidationException $exception) {
                $messages = array();

                do {
                    $messages[] = $exception->getMessage();
                } while ($exception = $exception->getPrevious());

                $messages = array_map(function ($message, $index) {
                    return sprintf('#%s - %s', $index + 1, $message);
                }, $messages, array_keys($messages));

                $errorMessage = sprintf(
                    "Generator run for '%s' caused an error:\n%s",
                    $type,
                    implode("\n", $messages)
                );

                throw new \Vaimo\ComposerChangelogs\Exceptions\GeneratorException($errorMessage);

                break;
            }
        }
    }
}
