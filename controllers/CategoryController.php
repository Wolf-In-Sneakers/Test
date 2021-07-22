<?php


namespace Shop\controllers;

use Exception;
use Shop\core\Controller;
use Shop\models\Category\Category;


class CategoryController extends Controller
{
    private Category $category;

    public function __construct()
    {
        parent::__construct();

        $this->category = new Category();
    }

    public function indexAction()
    {
        try {
            $list_categories = $this->category->listCategories();
        } catch (Exception $e) {
            $this->errors[] = $e->getMessage();
        }

        $path = "/category/list-categories.tmpl";
        $vars = [
            "errors" => $this->errors,
            "categories" => $list_categories["categories"]
        ];

        $this->view->render($path, $vars);
    }

    public function createAction()
    {
        try {
            if (!empty($_POST["add_category"])) {
                $add_category = $this->category->addCategory($_POST["name"]);
                $success = end($add_category["success"]);
            }
        } catch (Exception $e) {
            $this->errors[] = $e->getMessage();
        }


        $path = "/category/create-category.tmpl";
        $vars = [
            "errors" => $this->errors,
            "success" => $success
        ];

        $this->view->render($path, $vars);
    }

    public function changeAction(int $id_category)
    {
        try {
            $category = $this->category->viewCategory($id_category)["category"];

            if (!empty($_POST["change_category"])) {
                $change_category = $this->category->changeCategory($id_category, $_POST["name"]);
                $success = end($change_category["success"]);

                $category["name"] = htmlspecialchars((string)strip_tags(trim((string)$_POST["name"])));
            }
        } catch (Exception $e) {
            $this->errors[] = $e->getMessage();
        }


        $path = "/category/change-category.tmpl";
        $vars = [
            "errors" => $this->errors,
            "success" => $success,
            "category" => $category
        ];

        $this->view->render($path, $vars);
    }

    public function deleteAction(int $id_category)
    {
        try {
            $delete_category = $this->category->deleteCategory($id_category);

            http_response_code(200);
        } catch (Exception $e) {
            http_response_code(400);
            echo json_encode($e->getMessage());

        }
    }

    public function viewSubCategoriesAction(int $id_category)
    {
        try {
            $list_sub_categories = $this->category->listSubCategories($id_category);
        } catch (Exception $e) {
            $this->errors[] = $e->getMessage();
        }

        $path = "/category/list-sub-categories.tmpl";
        $vars = [
            "errors" => $this->errors,
            "subcategories" => $list_sub_categories["subcategories"],
            "category" => $list_sub_categories["category"]
        ];

        $this->view->render($path, $vars);
    }

    public function createSubCategoryAction(int $id_category)
    {
        try {
            $category = $this->category->viewCategory($id_category)["category"];

            if (!empty($_POST["add_sub_category"])) {
                $add_sub_category = $this->category->addSubCategory($id_category, $_POST["name"]);
                $success = end($add_sub_category["success"]);
            }
        } catch (Exception $e) {
            $this->errors[] = $e->getMessage();
        }


        $path = "/category/create-sub-category.tmpl";
        $vars = [
            "errors" => $this->errors,
            "success" => $success,
            "category" => $category
        ];

        $this->view->render($path, $vars);
    }

    public function changeSubCategoryAction(int $id_sub_category)
    {
        try {
            $sub_category = $this->category->viewSubCategory($id_sub_category)["subcategory"];

            if (!empty($_POST["change_sub_category"])) {
                $change_sub_category = $this->category->changeSubCategory($id_sub_category, $_POST["name"]);
                $success = end($change_sub_category["success"]);

                $sub_category["name"] = htmlspecialchars((string)strip_tags(trim((string)$_POST["name"])));
            }
        } catch (Exception $e) {
            $this->errors[] = $e->getMessage();
        }

        $path = "/category/change-sub-category.tmpl";
        $vars = [
            "errors" => $this->errors,
            "success" => $success,
            "subcategory" => $sub_category
        ];

        $this->view->render($path, $vars);
    }

    public function deleteSubCategoryAction(int $id_sub_category)
    {
        try {
            $delete_sub_category = $this->category->deleteSubCategory($id_sub_category);

            http_response_code(200);
        } catch (Exception $e) {
            http_response_code(400);
            echo json_encode($e->getMessage());

        }
    }

}