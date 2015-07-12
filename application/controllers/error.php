<?php

/**
 * Class Error
 *
 * Please note:
 * Don't use the same name for class and method, as this might trigger an (unintended) __construct of the class.
 * This is rea.lly weird behaviour, but documented here: http://php.net/manual/en/language.oop5.decon.php
 *
 */
class Error
{
    /**
     * PAGE: index
     * This method handles the error page that will be shown when a page is not found
     */
    public function index()
    {
        // load views
        require APP . 'views/admin/_templates/header.php';
        require APP . 'views/admin/error/index.php';
        require APP . 'views/admin/_templates/footer_blank.php';
    }
}
