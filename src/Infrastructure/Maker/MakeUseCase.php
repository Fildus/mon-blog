<?php

namespace App\Infrastructure\Maker;

use Symfony\Bundle\MakerBundle\ConsoleStyle;
use Symfony\Bundle\MakerBundle\DependencyBuilder;
use Symfony\Bundle\MakerBundle\Generator;
use Symfony\Bundle\MakerBundle\InputConfiguration;
use Symfony\Bundle\MakerBundle\Maker\AbstractMaker;
use Symfony\Bundle\MakerBundle\Str;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;

class MakeUseCase extends AbstractMaker
{
    public static function getCommandName(): string
    {
        return 'maker:use-case';
    }

    public function configureCommand(Command $command, InputConfiguration $inputConfig): void
    {
        $command
            ->setDescription("Create a new use case.")
            ->addArgument('domain', InputArgument::OPTIONAL, 'Select the domain name.')
            ->addArgument('name', InputArgument::OPTIONAL, 'Choose a name for your new use case.');
    }

    public function generate(InputInterface $input, ConsoleStyle $io, Generator $generator): void
    {
        $useCaseDomain = Str::asCamelCase($input->getArgument("domain"));
        $useCaseName = Str::asCamelCase($input->getArgument("name"));

        $domainDir = __DIR__ . "/../../../domain/src/" . $useCaseDomain;
        $useCaseDir = __DIR__ . "/../../../domain/useCase/";
        $domainTestDir = __DIR__ . "/../../../domain/tests/" . $useCaseDomain;
        $domainMockPresenterDir = __DIR__ . "/../../../domain/tests/__Mock/Adapter/Presenter/" . $useCaseDomain;

        is_dir($domainDir) ?: mkdir($domainDir);
        is_dir($domainTestDir) ?: mkdir($domainTestDir);

        $vars = array_merge(self::getVars($useCaseDomain, $useCaseName), ['useCaseDomain' => $useCaseDomain]);

        $skeletonDir = realpath(__DIR__ . '/../Resources/skeleton') . '/';

        $useCaseInterfaceDir = "${useCaseDir}/${useCaseName}";
        $useCaseDir = "${domainDir}/UseCase/${useCaseName}/${useCaseName}";

        $generator->generateFile("${useCaseInterfaceDir}UseCase.php", "${skeletonDir}use_case_interface.tpl.php", $vars);
        $generator->generateFile("${useCaseDir}.php", "${skeletonDir}use_case.tpl.php", $vars);
        $generator->generateFile("${useCaseDir}Request.php", "${skeletonDir}request.tpl.php", $vars);
        $generator->generateFile("${useCaseDir}Response.php", "${skeletonDir}response.tpl.php", $vars);
        $generator->generateFile("${useCaseDir}Presenter.php", "${skeletonDir}presenter.tpl.php", $vars);
        $generator->generateFile("${domainTestDir}/${useCaseName}Test.php", "${skeletonDir}test.tpl.php", $vars);
        $generator->generateFile("${domainMockPresenterDir}/${useCaseName}Presenter.php", "${skeletonDir}presenter_mock.tpl.php", $vars);

        $generator->writeChanges();

        $this->writeSuccessMessage($io);
    }

    /**
     * @return string[]
     */
    private static function getVars(string $useCaseDomain, string $useCaseName,): array
    {
        return [
            'test_nameSpace' => "Domain\\Tests\\${useCaseDomain}",
            'test_className' => "Domain\\Tests\\${useCaseDomain}\\${useCaseName}Test",
            'test_shortName' => "${useCaseName}Test",
            'presenterMock_className' => "Domain\\Tests\\__Mock\\Adapter\\Presenter\\${useCaseDomain}\\${useCaseName}Presenter",
            'presenterMock_nameSpace' => "Domain\\Tests\\__Mock\\Adapter\\Presenter\\${useCaseDomain}",
            'presenterMock_shortName' => "${useCaseName}Presenter",
            'useCase_className' => "Domain\\${useCaseDomain}\\UseCase\\${useCaseName}\\${useCaseName}",
            'useCase_nameSpace' => "Domain\\${useCaseDomain}\\UseCase\\${useCaseName}",
            'useCase_shortName' => $useCaseName,
            'request_className' => "Domain\\${useCaseDomain}\\UseCase\\${useCaseName}\\${useCaseName}Request",
            'request_nameSpace' => "Domain\\${useCaseDomain}\\UseCase\\${useCaseName}",
            'request_shortName' => "${useCaseName}Request",
            'response_className' => "Domain\\${useCaseDomain}\\UseCase\\${useCaseName}\\${useCaseName}Response",
            'response_nameSpace' => "Domain\\${useCaseDomain}\\UseCase\\${useCaseName}",
            'response_shortName' => "${useCaseName}Response",
            'presenter_className' => "Domain\\${useCaseDomain}\\UseCase\\${useCaseName}\\${useCaseName}Presenter",
            'presenter_nameSpace' => "Domain\\${useCaseDomain}\\UseCase\\${useCaseName}",
            'presenter_shortName' => "${useCaseName}Presenter",
            'useCaseInterface_className' => "UseCase\\${useCaseName}UseCase",
            'useCaseInterface_nameSpace' => "UseCase",
            'useCaseInterface_shortName' => "${useCaseName}UseCase",
        ];
    }

    public function configureDependencies(DependencyBuilder $dependencies): void
    {
    }
}