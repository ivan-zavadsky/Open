<?php

class Setname extends Command
{
    public function execute($args, $params)
    {
        if (!$this->isValid($args, $params)) {
            return;
        }
        list($oldName, $newName) = $this->parseArguments($args, $params);

        $commands = $this->storage->getCommands();
        foreach ($commands as $key => $value) {
            if ($oldName == $value['name']) {
                $commands[] = [
                    'name' => $newName,
                    'class' => $value['class'],
                    'description' =>$value['description'],
                ];
                unset($commands[$key]);
                $this->storage->putCommands($commands);
                return;
            }
        }
    }

    protected function isValid($args, $params)
    {
        $oldName = $args[0];
        $newName = $args[1];
        $oldIsRegistered = (bool) $this->getCommandByName($oldName);
        $newIsRegistered = (bool) $this->getCommandByName($newName);
        if (
            !$oldName
            || !$newName
            || !$oldIsRegistered
            || $newIsRegistered
        ) {
            echo "Validation fail\n";
            return false;
        }

        return true;
    }

    protected function parseArguments($args, $params):array
    {
        return [$args[0], $args[1]];
    }
}