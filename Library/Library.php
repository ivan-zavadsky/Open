<?php
require_once 'Register.php';
class Library extends Command
{
    const STATUS_OK = 0;

    public function execute($args = '', $params = '')
    {
        while (true) {
            $this->parser->clear();
            fwrite(STDOUT, "Please, enter command:\n");
            $rawCommand = trim(fgets(STDIN));
            list($command, $arguments, $options) = $this->parser->parse($rawCommand);
            if ($this->isRegistered($command) && $this->isExecutable($command)) {
                (new $command(new Parser()))->execute($arguments, $options);
            }
        }
        exit(self::STATUS_OK);
    }

}



























