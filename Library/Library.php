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
            if (!$this->isValid($rawCommand)) {
                echo "Enter at least one symbol\n";
                continue;
            }
            list($command, $arguments, $options) = $this->parseArguments($rawCommand);
            if (
                $this->isRegistered($command)
                && $this->isExecutable($command)
            ) {
                (new $command($this->storage))->execute($arguments, $options);
            }
        }
        exit(self::STATUS_OK);
    }

    protected function isValid($args, $params = '')
    {
        return strlen($args) > 0;
    }

    protected function parseArguments($args, $params = '')
    {
        return $this->parser->parse($args);
    }

}



























