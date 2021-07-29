<?php
namespace Ivan\Console;

abstract class Command
{
    public string $name;
    public string $description;
    public IStorage $storage;

    public function __construct(IStorage $storage)
    {
        $this->storage = $storage;
    }

    abstract function execute($arguments, $options);

    abstract protected function isValid($args, $params);

    protected function help($args, $class = null)
    {
        if (count($args) == 1 && $args[0] == 'help') {
            $commands = $this->storage->getCommands();
            foreach ($commands as $command) {
                if ($command['class'] == strtolower($class)) {
                    echo "Description: " . $command['description'] . "\n";
                    return true;
                }
            }
        }

        return false;
    }

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
