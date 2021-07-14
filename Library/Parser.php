<?php

class Parser
{
    public string $rawCommand;
    public string $command = '';
    public array $options = [];
    public array $arguments = [];

    public function parse(string $command)
    {
        $this->rawCommand = $command;
        $this->parseOptions();
        $this->removeOptionsFromCommand();
        $this->parseArguments();
        $this->removeArgumentsFromCommand();
        $this->parseCommand();

        return [
            $this->command,
            $this->arguments,
            $this->options
        ];
    }

    public function clear()
    {
        $this->rawCommand = '';
        $this->command = '';
        $this->options = [];
        $this->arguments = [];
    }

    private function parseOptions()
    {
        preg_match_all(
            '/\[.+?\]/',
            $this->rawCommand,
            $options
        );
        $options = $options[0];

        $this->options = [];
        foreach ($options as $option) {
            $option = $this->removeBrackets($option);
            list($optionName, $optionValue) = explode('=', $option);

            $isValueMultiple = preg_match(
                '/\{.+?\}/',
                $optionValue,
                $optionValuesArray
            );

            if (!$isValueMultiple) {
                $this->options[$optionName] = $optionValue;
            } else {
                $this->options[$optionName] = explode(
                    ',',
                    $this->removeBrackets(
                        $optionValuesArray[0]
                    )
                );
            }
        }

    }

    private function removeOptionsFromCommand()
    {
        $this->rawCommand = preg_replace(
            '/\[.+?\]/',
            '',
            $this->rawCommand
        );
    }

    private function parseArguments()
    {
        preg_match_all(
            '/\{.+?\}/',
            $this->rawCommand,
            $rawArguments
        );
        $rawArguments = $rawArguments[0];

        foreach ($rawArguments as $rawArgument) {
            $this->arguments = array_merge(
                $this->arguments,
                explode(',', $this->removeBrackets($rawArgument))
            );
        }
    }

    private function removeArgumentsFromCommand()
    {
        $this->rawCommand = preg_replace(
            '/\{.+?\}/',
            '',
            $this->rawCommand
        );
    }

    private function parseCommand()
    {
        $this->command = trim($this->rawCommand);
    }

    private function removeBrackets(string $string)
    {
        return substr($string, 1, -1);
    }

}