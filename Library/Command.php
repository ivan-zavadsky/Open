<?php

abstract class Command
{
    public string $name;
    public string $description;
    public Storage $storage;

    public function __construct(Storage $storage)
    {
        $this->storage = $storage;
    }

    public function execute($arguments, $options)
    {
        $commands = $this->storage->getCommands();
        echo "$this->description\n";
    }

    abstract protected function isValid($args, $params);

    abstract protected function parseArguments($args, $params);

    protected function isExecutable($command)
    {
        if (!class_exists($command['class'])) {
            echo "Class " . $command['class'] . " doesn't exist. Add the class to use the command\n";
            return false;
        }

        return true;
    }

    protected function getCommandByName($name)
    {
        $commands = $this->storage->getCommands();
        foreach ($commands as $key => $value) {
            if ($name == $value['name']) {
                return $value;
            }
        }
    }

}
