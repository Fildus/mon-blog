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
    private string $useCaseDomain;
    private string $useCaseName;

    public static function getCommandName(): string
    {
        return 'maker:use-case';
    }

    public function configureCommand(Command $command, InputConfiguration $inputConfig)
    {
        $command
            ->setDescription("Create a new use case.")
            ->addArgument('domain', InputArgument::OPTIONAL, 'Select the domain name.')
            ->addArgument('name', InputArgument::OPTIONAL, 'Choose a name for your new use case.');
    }

    public function generate(InputInterface $input, ConsoleStyle $io, Generator $generator)
    {
        $this->useCaseDomain = Str::asCamelCase($input->getArgument("domain"));
        $this->useCaseName = Str::asCamelCase($input->getArgument("name"));

        $domainDir = __DIR__ . "/../../../domain/src/" . $this->useCaseDomain;
        $domainTestDir = __DIR__ . "/../../../domain/tests/" . $this->useCaseDomain;

        is_dir($domainDir) ?: mkdir($domainDir);
        is_dir($domainTestDir) ?: mkdir($domainTestDir);

        $test_NamespaceDetails = $this->getClassDetails("Domain\\Tests\\".$this->useCaseDomain, "Test");
        $test_NamespaceDetails['nameSpace'] = "Domain\\Tests\\".$this->useCaseDomain;
        $useCase_NamespaceDetails = $this->getClassDetails("Domain\\" . $this->useCaseDomain . "\\UseCase");
        $request_NamespaceDetails = $this->getClassDetails("Domain\\" . $this->useCaseDomain . "\\UseCase", "Request");
        $response_NamespaceDetails = $this->getClassDetails("Domain\\" . $this->useCaseDomain . "\\UseCase", "Response");
        $presenter_NamespaceDetails = $this->getClassDetails("Domain\\" . $this->useCaseDomain . "\\UseCase", "Presenter");

        $generator->generateFile(
            "${domainDir}/UseCase/${useCase_NamespaceDetails['shortName']}/${useCase_NamespaceDetails['shortName']}.php",
            $this->getSkeletonFilePath('use_case.tpl.php'),
            [
                'className' => $useCase_NamespaceDetails['shortName'],
                'namespace' => $useCase_NamespaceDetails['nameSpace'],
                'requestClassName' => $request_NamespaceDetails['shortName'],
                'responseClassName' => $response_NamespaceDetails['shortName'],
                'presenterInterfaceName' => $presenter_NamespaceDetails['shortName']
            ]
        );

        $generator->generateFile(
            "${domainDir}/UseCase/${useCase_NamespaceDetails['shortName']}/${request_NamespaceDetails['shortName']}.php",
            $this->getSkeletonFilePath('request.tpl.php'),
            [
                'className' => $request_NamespaceDetails['shortName'],
                "namespace" => $useCase_NamespaceDetails['nameSpace']
            ]
        );

        $generator->generateFile(
            "${domainDir}/UseCase/${useCase_NamespaceDetails['shortName']}/${response_NamespaceDetails['shortName']}.php",
            $this->getSkeletonFilePath('response.tpl.php'),
            [
                'className' => $response_NamespaceDetails['shortName'],
                'namespace' => $useCase_NamespaceDetails['nameSpace']
            ]
        );

        $generator->generateFile(
            "${domainDir}/UseCase/${useCase_NamespaceDetails['shortName']}/${presenter_NamespaceDetails['shortName']}.php",
            $this->getSkeletonFilePath('presenter.tpl.php'),
            [
                'className' => $presenter_NamespaceDetails['shortName'],
                'namespace' => $useCase_NamespaceDetails['nameSpace'],
                'responseClassName' => $response_NamespaceDetails['shortName']
            ]
        );

        $generator->generateFile(
            "${domainTestDir}/${test_NamespaceDetails['shortName']}.php",
            $this->getSkeletonFilePath('test.tpl.php'),
            [
                'useCaseDomain' => $this->useCaseDomain,
                'className' => $test_NamespaceDetails['shortName'],
                'namespace' => $test_NamespaceDetails['nameSpace'],
                'useCaseClassName' => $useCase_NamespaceDetails['shortName'],
                'useCaseNamespace' => $useCase_NamespaceDetails['className'],
                'requestClassName' => $request_NamespaceDetails['shortName'],
                'requestNamespace' => $request_NamespaceDetails['className'],
                'responseClassName' => $response_NamespaceDetails['shortName'],
                'responseNamespace' => $response_NamespaceDetails['className'],
                'presenterInterfaceName' => $presenter_NamespaceDetails['shortName'],
                'presenterNamespace' => $presenter_NamespaceDetails['className']
            ]
        );

        $generator->writeChanges();

        $this->writeSuccessMessage($io);
    }

    public function configureDependencies(DependencyBuilder $dependencies)
    {
    }

    private function getClassDetails(string $namespacePrefix, string $suffix = ''): array
    {
        return [
            'className' => $namespacePrefix . '\\' . $this->useCaseName . '\\' . $this->useCaseName . $suffix,
            'nameSpace' => $namespacePrefix . '\\' . $this->useCaseName,
            'shortName' => $this->useCaseName . $suffix
        ];
    }

    private function getSkeletonFilePath(string $fileName): string
    {
        return realpath(__DIR__ . '/../Resources/skeleton') . '/' . $fileName;
    }
}