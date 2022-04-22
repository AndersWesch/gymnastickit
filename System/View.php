<?php

namespace App\System;

class View
{
    /**
     * Render the view
     *
     * @param string
     * @param Array[]
     * @param string $title
     */
    public function render(
        $viewPath,
        $data = [],
        $title = 'Title',
        $footer = true
    ) {
        $this->view = $viewPath;
        $this->data = $data;
        $this->title = $title;
        $this->footer = $footer;

        require('../views/layout.php');
    }
}
