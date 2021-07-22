<?php


namespace Shop\controllers;

use Exception;
use Shop\core\Controller;
use Shop\models\Material\Material;
use Shop\models\Tag\Tag;


class TagController extends Controller
{
    private Material $material;
    private Tag $tag;

    public function __construct()
    {
        parent::__construct();

        $this->material = new Material();
        $this->tag = new Tag();
    }

    public function indexAction()
    {
        try {
            $list_tag = $this->tag->listTags();
        } catch (Exception $e) {
            $this->errors[] = $e->getMessage();
        }

        $path = "/tag/list-tags.tmpl";
        $vars = [
            "errors" => $this->errors,
            "tags" => $list_tag["tags"]
        ];

        $this->view->render($path, $vars);
    }

    public function createAction()
    {
        try {
            if (!empty($_POST["add_tag"])) {
                $add_tag = $this->tag->addTag($_POST["name"]);
                $success = end($add_tag["success"]);
            }
        } catch (Exception $e) {
            $this->errors[] = $e->getMessage();
        }


        $path = "/tag/create-tag.tmpl";
        $vars = [
            "errors" => $this->errors,
            "success" => $success
        ];

        $this->view->render($path, $vars);
    }

    public function viewAction(int $id_tag)
    {
        try {
            $search_materials_to_tag = $this->material->searchMaterialToTag($id_tag);
            $tag = $this->tag->viewTag($id_tag)["tag"];


        } catch (Exception $e) {
            $this->errors[] = $e->getMessage();
        }


        $path = "/tag/list-materials.tmpl";
        $vars = [
            "errors" => $this->errors,
            "tag" => $tag,
            "materials" => $search_materials_to_tag["materials"]
        ];

        $this->view->render($path, $vars);
    }

    public function changeAction(int $id_tag)
    {
        try {
            $tag = $this->tag->viewTag($id_tag)["tag"];

            if (!empty($_POST["change_tag"])) {
                $change_tag = $this->tag->changeTag($id_tag, $_POST["name"]);
                $success = end($change_tag["success"]);

                $tag["name"] = htmlspecialchars((string)strip_tags(trim((string)$_POST["name"])));
            }
        } catch (Exception $e) {
            $this->errors[] = $e->getMessage();
        }


        $path = "/tag/change-tag.tmpl";
        $vars = [
            "errors" => $this->errors,
            "success" => $success,
            "tag" => $tag
        ];

        $this->view->render($path, $vars);
    }

    public function deleteAction(int $id_tag)
    {
        try {
            $delete_tag = $this->tag->deleteTag($id_tag);

            http_response_code(200);
        } catch (Exception $e) {
            http_response_code(400);
            echo json_encode($e->getMessage());

        }
    }
}