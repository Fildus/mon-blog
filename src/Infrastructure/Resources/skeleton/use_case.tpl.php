<?php echo "<?php\n" ?>

namespace <?php echo $namespace; ?>;

class <?php echo $className; ?><?php echo "\n" ?>
{
    public function __construct(
        //private EntityRepository $repository
    ) { }

    public function execute(<?php echo $requestClassName ?> $request, <?php echo $presenterInterfaceName ?> $presenter): void
    {
        /*
        $domainEntity = new DomainEntity(
            uuid: $theUuid,
            someVars: $request->someVars,
        );

        $this->repository->doSomething($domainEntity);

        $presenter->present(new <?php echo $responseClassName ?>(
            domainEntity: $domainEntity ?? null
        ));
        */
    }
}
