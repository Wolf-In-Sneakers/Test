<?php


namespace Shop\controllers;

use Exception;
use Shop\core\Controller;
use Shop\models\Type\Type;


class TypeController extends Controller
{
    private Type $type;

    public function __construct()
    {
        parent::__construct();

        $this->type = new Type();
    }

    public function indexAction()
    {
        try {
            $list_type = $this->type->listTypes();
        } catch (Exception $e) {
            $this->errors[] = $e->getMessage();
        }

        $path = "/type/list-types.tmpl";
        $vars = [
            "errors" => $this->errors,
            "types" => $list_type["types"]
        ];

        $this->view->render($path, $vars);
    }

    public function createAction()
    {
        try {
            if (!empty($_POST["add_type"])) {
                $add_type = $this->type->addType($_POST["name"]);
                $success = end($add_type["success"]);
            }
        } catch (Exception $e) {
            $this->errors[] = $e->getMessage();
        }


        $path = "/type/create-type.tmpl";
        $vars = [
            "errors" => $this->errors,
            "success" => $success
        ];

        $this->view->render($path, $vars);
    }

    public function changeAction(int $id_type)
    {
        try {
            $type = $this->type->viewType($id_type)["type"];

            if (!empty($_POST["change_type"])) {
                $change_type = $this->type->changeType($id_type, $_POST["name"]);
                $success = end($change_type["success"]);

                $type["name"] = htmlspecialchars((string)strip_tags(trim((string)$_POST["name"])));
            }
        } catch (Exception $e) {
            $this->errors[] = $e->getMessage();
        }


        $path = "/type/change-type.tmpl";
        $vars = [
            "errors" => $this->errors,
            "success" => $success,
            "type" => $type
        ];

        $this->view->render($path, $vars);
    }

    public function deleteAction(int $id_type)
    {
        try {
            $delete_type = $this->type->deleteType($id_type);

            http_response_code(200);
        } catch (Exception $e) {
            http_response_code(400);
            echo json_encode($e->getMessage());

        }
    }
}