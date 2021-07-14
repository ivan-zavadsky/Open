<?php

class Setname extends Command
{
    public function execute($args, $params)
    {
        if (!$this->validate($args, $params)) {
            return;
        }

        list($oldName, $newName) = $this->parseArguments($args, $params);
        $commands = $this->getCommands();

        foreach ($commands as $name => $description) {
            if ($name == $oldName) {
                $commands[$newName] = $description;
                unset($commands[$oldName]);
                $this->putCommands($commands);
                echo "New name set successfully\n";
                break;
            }
        }
        $this->parser->clear();

    }

    protected function validate($args, $params)
    {
        if (
            !($oldName = $args[0])
            || !($newName = $args[1])
            || !$this->isRegistered($oldName)
            || $this->isRegistered($newName)
        ) {
            echo "Validation fail\n";
            return false;
        }

        return true;
    }

    protected function parseArguments($args, $params)
    {
        return [$args[0], $args[1]];
    }
}