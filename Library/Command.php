<?php

class Command
{
    public string $name;
    public string $description;
    public Parser $parser;

    public function __construct(Parser $parser)
    {
        $this->parser = $parser;
    }

    public function execute($arguments, $options)
    {

    }

    public function getCommands()
    {
        return json_decode(file_get_contents('db.txt'), true) ?? [];
    }

    public function putCommands($commands)
    {
        file_put_contents('db.txt', json_encode($commands));
    }

    protected function isRegistered($name)
    {
        $commands = $this->getCommands();
        if (!array_key_exists($name, $commands)/*false*/) {
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