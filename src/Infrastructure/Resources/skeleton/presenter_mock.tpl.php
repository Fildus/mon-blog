<?php echo "<?php\n" ?>

namespace <?= $presenterMock_nameSpace ?>;

use <?= $response_className ?>;

class <?= $presenterMock_shortName ?> implements \<?= $presenter_className ?><?= "\n" ?>
{
    public <?= $response_shortName ?> $response;

    public function present(<?= $response_shortName ?> $response): void
    {
        $this->response = $response;
    }
}