<?php

class Register extends Command
{
    private $errorMessage = "Command exists. Use another name\n";
    private $successMessage = "Registered successfully\n";

    public function execute($arguments, $options)
    {
        if (!$arguments || !$arguments[0]) {
            echo "Command \"register\" should have one argument!\n";
            return;
        }

        $name = $arguments[0];
        $description = '';
        $commands = $this->getCommands();

        if (!in_array($name, $commands)) {
            $commands[$name] = $description;
            $this->putCommands($commands);
            echo $this->successMessage;
        } else {
            echo $this->errorMessage;
        }
    }
}