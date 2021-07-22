<?php


namespace Shop\controllers;

use Exception;
use Shop\core\Controller;
use Shop\models\Link\Link;


class LinkController extends Controller
{
    private Link $link;

    public function __construct()
    {
        parent::__construct();

        $this->link = new Link();
    }

    public function deleteAction(int $id_link)
    {
        try {
            $delete_link = $this->link->deleteLink($id_link);

            http_response_code(200);
        } catch (Exception $e) {
            http_response_code(400);
            echo json_encode($e->getMessage());

        }
    }
}