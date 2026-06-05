<?php
namespace Controller;
use UI\viewHome;
use Foundation\Session;
use Foundation\Persistent\PersistentManager;
use Model\Studente;
class HomeController{

    public function dashboard() : void {
        $session = Session::getInstance();
        $user = $session->getSessionElement('studente');
        $view = new viewHome();
        if (!isset($user) || $user === null) {
            $view->mostraHome(null, null);
            exit;
        }else {
            $pm = PersistentManager::getInstance();
            $studente = $pm->find(Studente::class, $user);
            $username = $studente->getUsername();
            if ($studente->getImmagineProfilo() === null) {
                $base64 = null;
            } else {
            $base64 = $studente->getImmagineProfilo() && $studente->getImmagineProfilo()->getContenutoFile() !== null
    ? 'data:' . $studente->getImmagineProfilo()->getMimeType() . ';base64,' . base64_encode(
        is_resource($studente->getImmagineProfilo()->getContenutoFile())
            ? stream_get_contents($studente->getImmagineProfilo()->getContenutoFile())
            : $studente->getImmagineProfilo()->getContenutoFile()
    )
    : null;
            }
            $view->mostraHome($username, $base64);
        }
    }

    public function index() : void {
        $view = new viewHome();
        $view->index();
    }
}