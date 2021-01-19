<?= "<?php\n" ?>

namespace <?= $useCaseInterface_nameSpace; ?>;

use <?= $presenter_className; ?>;
use <?= $request_className; ?>;

interface <?= $useCaseInterface_shortName; ?><?= "\n" ?>
{
    public function execute(<?= $request_shortName ?> $request, <?= $presenter_shortName ?> $presenter): void;
}
