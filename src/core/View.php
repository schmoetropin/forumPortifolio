<?php
declare(strict_types=1);

namespace Src\Core;

class View
{
    /**
     * @var string
     */
    private string $layout = 'mainLayout';

    /**
     * @param string $content
     * @param array $data
     * @return string
     */
    public function getFullPage(string $content, array $data = []): string
    {
        $layout = $this->setLayout();
        $pageCon = $this->getContent($content, $data);
        $fullPage = str_replace('{{*CONTENT*}}', $pageCon, $layout);
        return $fullPage;
    }

    /**
     * @return string
     */
    public function setLayout(): string
    {
        ob_start();
        require_once(LAYOUT_PATH.$this->layout.'.php');
        return ob_get_clean();
    }

    /**
     * @param string $content
     * @param array $data
     * @return string
     */
    public function getContent(string $content, array $data = []): string
    {
        if (!empty($data)) {
            foreach ($data as $key => $value) {
                $$key = $value;
            }
        }

        ob_start();
        require_once(PAGES_PATH.$content.'.php');
        return ob_get_clean();
    }
}