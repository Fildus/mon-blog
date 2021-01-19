<?= "<?php\n" ?>

namespace <?= $useCase_nameSpace; ?>;

use <?= $useCaseInterface_className; ?>;

class <?= $useCase_shortName; ?> implements <?= $useCaseInterface_shortName; ?><?= "\n" ?>
{
    public function __construct(
        //private EntityRepository $repository
    ) { }

    public function execute(<?= $request_shortName ?> $request, <?= $presenter_shortName ?> $presenter): void
    {
        /*
        $domainEntity = new DomainEntity(
            uuid: $theUuid,
            someVars: $request->someVars,
        );

        $this->repository->doSomething($domainEntity);

        $presenter->present(new <?= $response_shortName ?>(
            domainEntity: $domainEntity ?? null
        ));
        */
    }
}
