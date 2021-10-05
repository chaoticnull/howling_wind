<?php

namespace HowlingWind\Libraries;

class View
{
    private string $file;
    private array $data;

    public function __construct(string $file)
    {
        $this->file = $file;
    }

    // Render view 
    public function render(array $data): void
    {
        $this->data = $data;
        require_once($this->file);
    }

    // Return view as string
    public function fetch(array $data): string
    {
        $this->data = $data;
        ob_start();
        include($this->file);
        return ob_get_clean();
    }

    public function get_data(): array
    {
        return $this->data;
    }
}
