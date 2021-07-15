<?php
require_once 'Register.php';
class Library extends Command
{
    const STATUS_OK = 0;

    public Parser $parser;

    public function __construct(Storage $storage, Parser $parser)
    {
        parent::__construct($storage);
        $this->parser = $parser;
    }

    public function execute($args = '', $params = '')
    {
        while (true) {
            $this->parser->clear();
            fwrite(STDOUT, "Please, enter command:\n");
            $rawCommand = trim(fgets(STDIN));
            list($name, $arguments, $options) = $this->parseArguments($rawCommand);
            $name = $name ?? 'help';

            $command = $this->getCommandByName($name);
            if (
                $command
                && $this->isExecutable($command)
            ) {
                (new $command['class']($this->storage))->execute($arguments, $options);
            }
        }
        exit(self::STATUS_OK);
    }

    protected function isValid($args, $params = '')
    {
        return true;
    }

    protected function parseArguments($args, $params = '')
    {
        return $this->parser->parse($args);
    }

    protected function listRegistered()
    {
        $commands = $this->storage->getCommands();
        echo "Registered commands:\n";
        foreach ($commands as $name => $description) {
            echo "* $name\n";
        }
    }

}



























