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
        $title = 'Title'
    ) {
        $this->view = $viewPath;
        $this->data = $data;
        $this->title = $title;

        require('../views/layout.php');
    }
}
