<?php echo "<?php\n" ?>

namespace <?php echo $namespace; ?>;

interface <?php echo $className; ?><?php echo "\n" ?>
{
    public function present(<?php echo $responseClassName ?> $response): void;
}
