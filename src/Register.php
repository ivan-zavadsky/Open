<?php
namespace Ivan\Console;

class Register extends Command
{
    private string $errorMessage = "Command exists. Use another name\n";
    private string $successMessage = "Registered successfully\n";

    public function execute($arguments, $options)
    {
        if (!$this->isValid($arguments, $options)) {
            echo "Registration validation error\n";
            return;
        }
        list($name, $class) = $this->parseArguments($arguments, $options);
        $class = $class ?? $name;
        $description = '';
        $commands = $this->storage->getCommands();

        if ($this->getCommandByName($name)) {
            echo $this->errorMessage;
        } else {
            $commands[] = [
                'name' => $name,
                'class' => $class,
                'description' => $description,
            ];
            $this->storage->putCommands($commands);
            echo $this->successMessage;
        }

    }

    protected function isValid($arguments, $options)
    {
        if (parent::help($arguments, __CLASS__)) {
            return;
        }

        return $arguments && $arguments[0];
    }

    protected function parseArguments($arguments, $options)
    {
        parent::parseArguments($arguments, $options);

        $class = isset($arguments[1]) ? $arguments[1] : null;

        return [$arguments[0], $class];
    }
}