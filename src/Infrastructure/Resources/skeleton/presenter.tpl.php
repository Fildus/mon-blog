<?= "<?php\n" ?>

namespace <?= $presenter_nameSpace; ?>;

interface <?= $presenter_shortName; ?><?= "\n" ?>
{
    public function present(<?= $response_shortName ?> $response): void;
}
