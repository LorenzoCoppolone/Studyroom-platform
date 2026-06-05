<?php
namespace Controller;

use UI\viewInfo;

class InfoController {

    public function chiSiamo() : void {
        $view = new viewInfo();
        $view->chiSiamo();
    }

    public function supporto() : void {
        $view = new viewInfo();
        $view->supporto();
    }

    public function faq() : void {
        $view = new viewInfo();
        $view->faq();
    }

    public function termini() : void {
        $view = new viewInfo();
        $view->termini();
    }
}
