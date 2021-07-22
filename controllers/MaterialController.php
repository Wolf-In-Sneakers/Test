<?php


namespace Shop\controllers;

use Exception;
use Shop\core\Controller;
use Shop\models\Category\Category;
use Shop\models\Link\Link;
use Shop\models\Material\Material;
use Shop\models\Tag\Tag;
use Shop\models\Type\Type;


class MaterialController extends Controller
{
    private Material $material;
    private Tag $tag;
    private Category $category;
    private Type $type;
    private Link $link;

    public function __construct()
    {
        parent::__construct();

        $this->material = new Material();
        $this->tag = new Tag();
        $this->category = new Category();
        $this->type = new Type();
        $this->link = new Link();

    }

    public function indexAction()
    {
        try {
            if (!empty($_POST["search"])) {
                $list_materials = $this->material->searchMaterials($_POST["name"]);
            } else {
                $list_materials = $this->material->listMaterials();
            }

        } catch (Exception $e) {
            $this->errors[] = $e->getMessage();
        }


        $path = "/material/list-materials.tmpl";
        $vars = [
            "errors" => $this->errors,
            "materials" => $list_materials["materials"]
        ];

        $this->view->render($path, $vars);
    }

    public function createAction()
    {
        try {
            if (!empty($_POST["add_material"])) {
                $add_material = $this->material->addMaterial($_POST["name"], $_POST["id_category"], $_POST["id_type"], $_POST["author"], $_POST["description"],);
                $success = end($add_material["success"]);
            }
        } catch (Exception $e) {
            $this->errors[] = $e->getMessage();
        }


        $path = "/material/create-material.tmpl";
        $vars = [
            "errors" => $this->errors,
            "success" => $success,
            "types" => $this->type->listTypes()["types"],
            "categories" => $this->category->listCategoriesAndSubCategories()["categories"]
        ];

        $this->view->render($path, $vars);
    }


    public function viewAction(int $id_material)
    {
        try {
            $view_material = $this->material->viewMaterial($id_material);

            if (!empty($_POST["add_tag"])) {
                $add_tag = $this->material->addTagToMaterial($id_material, $_POST["id_tag"]);
            } else if (!empty($_POST["add_link"])) {
                $add_link = $this->link->addLink($id_material, $_POST["link"], $_POST["name"]);
            } else if (!empty($_POST["change_link"])) {
                $change_link = $this->link->changeLink($_POST["id_link"], $_POST["link"], $_POST["name"]);
            }
        } catch (Exception $e) {
            $this->errors[] = $e->getMessage();
        }

        try {
            $material_tags = $this->material->listTagsMaterial($id_material)["tags"];
            $tags = $this->tag->listTags()["tags"];

            $links = $this->link->listLinks($id_material)["links"];

            foreach ($tags as $key => $val) {
                foreach ($material_tags as $mat_val) {
                    if ($val["id_tag"] == $mat_val["id_tag"])
                        unset($tags[$key]);
                }
            }
        } catch (Exception $e) {
            $this->errors[] = $e->getMessage();
        }


        $path = "/material/view-material.tmpl";
        $vars = [
            "errors" => $this->errors,
            "material" => $view_material["material"],
            "tags" => $tags,
            "material_tags" => $material_tags,
            "links" => $links
        ];

        $this->view->render($path, $vars);
    }

    public function changeAction(int $id_material)
    {
        try {
            $material = $this->material->viewMaterial($id_material)["material"];

            if (!empty($_POST["change_material"])) {
                $add_material = $this->material->changeMaterial($id_material, $_POST["name"], $_POST["id_category"], $_POST["id_type"], $_POST["author"], $_POST["description"]);
                $success = end($add_material["success"]);

                $material["name"] = htmlspecialchars((string)strip_tags(trim((string)$_POST["name"])));
                $material["id_category"] = htmlspecialchars((int)strip_tags(trim((int)$_POST["id_category"])));
                $material["id_type"] = htmlspecialchars((int)strip_tags(trim((int)$_POST["id_type"])));
                $material["author"] = htmlspecialchars((string)strip_tags(trim((string)$_POST["author"])));
                $material["description"] = htmlspecialchars((string)strip_tags(trim((string)$_POST["description"])));
            }
        } catch (Exception $e) {
            $this->errors[] = $e->getMessage();
        }


        $path = "/material/change-material.tmpl";
        $vars = [
            "errors" => $this->errors,
            "success" => $success,
            "material" => $material,
            "types" => $this->type->listTypes()["types"],
            "categories" => $this->category->listCategoriesAndSubCategories()["categories"]
        ];

        $this->view->render($path, $vars);
    }

    public function deleteTagAction(int $id_material, int $id_tag)
    {
        try {
            $delete_material_tag = $this->material->deleteTagFromMaterial($id_material, $id_tag);

            http_response_code(200);
        } catch (Exception $e) {
            http_response_code(400);
            echo json_encode($e->getMessage());

        }
    }

    public function deleteAction(int $id_material)
    {
        try {
            $delete_material = $this->material->deleteMaterial($id_material);

            http_response_code(200);
        } catch (Exception $e) {
            http_response_code(400);
            echo json_encode($e->getMessage());

        }
    }

}