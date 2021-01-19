<?php echo "<?php\n" ?>

namespace <?= $test_nameSpace; ?>;

use <?= $presenterMock_className ?>;
use <?= $request_className ?>;
use <?= $response_className ?>;
use <?= $useCase_className ?>;
use PHPUnit\Framework\TestCase;

class <?= $test_shortName; ?> extends TestCase
{
    private <?= $presenter_shortName ?> $presenter;
    private <?= $useCase_shortName ?> $useCase;
    private <?= $useCaseDomain ?>Repository $repository;

    protected function setUp(): void
    {
        $this->repository = new <?= $useCaseDomain ?>Repository();
        $this->presenter = new <?= $presenter_shortName ?>();
        $this->useCase = new <?= $useCase_shortName ?>($this->repository);
    }

    public function test(): void
    {
        $request = new <?= $request_shortName; ?>(
            //someVar: 'something'
        );

        $this->useCase->execute($request, $this->presenter);

        $this->assertInstanceOf(<?= $response_shortName ?>::class, $this->presenter->response);
    }
}
