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

    abstract public function execute($arguments, $options);

    abstract protected function isValid($args, $params);

    abstract protected function parseArguments($args, $params);

    protected function isRegistered($name)
    {
        $commands = $this->storage->getCommands();
        if (!array_key_exists($name, $commands)) {
            echo "Command $name is not registered\n";
            return false;
        }

        return true;
    }

    protected function isExecutable($name)
    {
        if (!class_exists($name)) {
            echo "Class $name doesn't exist. Add the class to use the command\n";
            return false;
        }

        return true;
    }

}

//command_name {verbose,overwrite} [log_file=app.log] {unlimited} [methods={create,update,delete}] [paginate=50] {log}