<?php

class Help extends Command
{
    public function execute($args, $params)
    {
        $commands = $this->storage->getCommands();
        foreach ($commands as $command) {
            echo "Command: " . $command['name'] . "; Description: " . $command['description'] . "\n";

        }

    }

    protected function isValid($args, $params)
    {
        return true;
    }

    protected function parseArguments($args, $params)
    {
        return [];
    }
}