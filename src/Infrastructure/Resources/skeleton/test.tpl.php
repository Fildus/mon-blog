<?php echo "<?php\n" ?>

namespace <?= $namespace; ?>;

use <?= $presenterNamespace ?>;
use <?= $requestNamespace ?>;
use <?= $responseNamespace ?>;
use <?= $useCaseNamespace ?>;
use PHPUnit\Framework\TestCase;

class <?= $className; ?> extends TestCase
{
    private <?= $presenterInterfaceName ?> $presenter;
    private <?= $useCaseClassName ?> $useCase;
    private <?= $useCaseDomain ?>Repository $repository;

    protected function setUp(): void
    {
        $this->repository = new <?= $useCaseDomain ?>Repository();

        $this->presenter = new class () implements <?= $presenterInterfaceName ?> {
            public <?= $responseClassName ?> $response;

            public function present(<?= $responseClassName ?> $response): void
            {
                $this->response = $response;
            }
        };

        $this->useCase = new <?= $useCaseClassName ?>($this->repository);
    }

    public function test(): void
    {
        $request = new <?php echo $requestClassName; ?>(
            //someVar: 'something'
        );

        $this->useCase->execute($request, $this->presenter);

        $this->assertInstanceOf(<?php echo $responseClassName ?>::class, $this->presenter->response);
    }
}
