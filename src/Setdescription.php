<?php
namespace Ivan\Console;

class Setdescription extends Command
{
    public function execute($arguments, $options)
    {
        if (!$this->isValid($arguments, $options)) {
            echo "The command should have exactly 2 arguments\n";
            return;
        }

        list($name, $description) = $this->parseArguments($arguments, $options);

        $commands = $this->storage->getCommands();
        foreach ($commands as $key => $value) {
            if ($name == $value['name']) {
                $commands[$key]['description'] = $description;
                $this->storage->putCommands($commands);
                echo "Description changed\n";
                break;
            }
        }
    }

    protected function isValid($arguments, $options)
    {
        if (parent::help($arguments, __CLASS__)) {
            return;
        }

        return $arguments && $arguments[0] && $arguments[1];
    }

    protected function parseArguments($arguments, $options): array
    {
        return [$arguments[0], $arguments[1]];
    }
}