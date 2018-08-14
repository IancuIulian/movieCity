<?php
declare(strict_types = 1);

namespace View;


class View
{
    const VIEW_ROOT = 'src/pages/';
    const FILES_EXTENSION = 'phtml';
    protected $template;

    public function __construct(string $template)
    {
        $this->template = self::VIEW_ROOT . $template . '.' . self::FILES_EXTENSION;
    }

    public function render(array $data)
    {
        extract($data);
        ob_start();
        require_once $this->template;
        $output = ob_get_contents();
//        ob_end_clean();
        return $output;
    }

}