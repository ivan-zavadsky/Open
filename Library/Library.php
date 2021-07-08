<?php

class Library
{
    const STATUS_OK = 0;

    public Parser $parser;
    public array $commands = [];

    public function __construct(Parser $parser)
    {
        $this->parser = $parser;
    }

    public function process()
    {
        while (true) {
            $this->parser = new Parser();
            fwrite(STDOUT, "Please, enter command:\n");
            $rawCommand = trim(fgets(STDIN));
            list($command, $arguments, $options) = $this->parser->parse($rawCommand);
            if ($command == 'register') {
                $this->register($arguments[0]);
                continue;
            }
            if (in_array($command, $this->commands)) {
                (new $command)->execute($arguments, $options);
            } else {
               echo "Command not found\n";
            }
        }
        exit(self::STATUS_OK);
    }

    private function register($command)
    {
        if (!in_array($command, $this->commands)) {
            $this->commands[] = $command;
            echo "Registered successfully\n";
        } else {
            echo "Command exists. Use another name\n";
        }
    }
}



























