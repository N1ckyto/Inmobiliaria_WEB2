<?php
function sessionAuthMiddleware($res)
{
    session_start();
    if (isset($_SESSION['ID_USER'])) {
        $res->user = new stdClass();
        $res->user->id = $_SESSION['ID_USER'];
        $res->user->user = $_SESSION['NAME_USER'];
        return;
    } else {
        $res->user = new stdClass();
        $res->user->id = "";
        $res->user->user = "";
        return;
    }
}
