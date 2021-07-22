<?php


namespace Shop\models\Category;

use Exception;
use Shop\core\Model;

class Category extends Model
{
    public function addCategory(string $name)
    {
        $message["success"] = [];

        if (empty($name)) {
            throw new Exception("Передаваемый аргумент пуст!");
        }

        $name = htmlspecialchars((string)strip_tags(trim((string)$name)));

        $sql_query = "INSERT INTO categories(name) VALUES (?);";
        $this->db->query($sql_query, [$name]);
        $message["success"][] = "Категория успешно добавлена!";

        return $message;
    }

    public function listCategories()
    {
        $message["success"] = [];

        $sql_query = "SELECT id_category, name FROM categories ORDER BY created;";
        $message["categories"] = $this->db->fetchAll($sql_query);
        $message["success"][] = "Категории успешно получены!";

        return $message;
    }

    public function listCategoriesAndSubCategories()
    {
        $message["success"] = [];

        $sql_query = "SELECT sc.id_sub_category as id_category, CONCAT(c.name,'/',sc.name) as name FROM categories c
                        INNER JOIN sub_categories sc ON c.id_category=sc.id_category 
                        ORDER BY c.id_category, sc.id_sub_category;";
        $message["categories"] = $this->db->fetchAll($sql_query);
        $message["success"][] = "Категории успешно получены!";

        return $message;
    }

    public function viewCategory(int $id_category)
    {
        $message["success"] = [];

        if (empty($id_category)) {
            throw new Exception("Передаваемый аргумент пуст!");
        }

        $id_category = htmlspecialchars((int)strip_tags(trim((int)$id_category)));

        $sql_query = "SELECT id_category, name FROM categories WHERE id_category=? LIMIT 1;";
        $message["category"] = $this->db->fetchRow($sql_query, [$id_category]);

        if(empty($message["category"])) {
            throw new Exception("Не удалось найти категорию!");
        }

        $message["success"][] = "Категория успешно получена!";

        return $message;
    }

    public function changeCategory(int $id_category, string $name)
    {
        $message["success"] = [];

        if ((empty($id_category)) || (empty($name))) {
            throw new Exception("Один или более передаваемых аргументов пусты!");
        }

        $id_category = htmlspecialchars((int)strip_tags(trim((int)$id_category)));
        $name = htmlspecialchars((string)strip_tags(trim((string)$name)));

        $sql_query = "UPDATE categories SET name=? WHERE id_category=?;";
        $this->db->query($sql_query, [$name, $id_category]);

        $message["success"][] = "Категория успешно изменена!";

        return $message;
    }

    public function deleteCategory(int $id_category)
    {
        $message["success"] = [];

        if (empty($id_category)) {
            throw new Exception("Передаваемый аргумент пуст!");
        }

        $id_category = htmlspecialchars((int)strip_tags(trim((int)$id_category)));

        $sql_query = "DELETE FROM categories WHERE id_category=?;";
        $this->db->query($sql_query, [$id_category]);
        $message["success"][] = "Категория успешно удалена!";

        return $message;
    }

    public function listSubCategories(int $id_category)
    {
        $message["success"] = [];

        if (empty($id_category)) {
            throw new Exception("Передаваемый аргумент пуст!");
        }

        $id_category = htmlspecialchars((int)strip_tags(trim((int)$id_category)));

        $sql_query = "SELECT sc.id_sub_category, sc.name FROM sub_categories sc WHERE id_category=? ORDER BY created;";
        $message["subcategories"] = $this->db->fetchAll($sql_query, [$id_category]);

        $sql_query = "SELECT id_category, name FROM categories WHERE id_category=? LIMIT 1;";
        $message["category"] = $this->db->fetchRow($sql_query, [$id_category]);

        if(empty($message["category"])) {
            throw new Exception("Не удалось найти категорию!");
        }

        $message["success"][] = "Подкатегории успешно получены!";

        return $message;
    }

    public function viewSubCategory(int $id_sub_category)
    {
        $message["success"] = [];

        if (empty($id_sub_category)) {
            throw new Exception("Передаваемый аргумент пуст!");
        }

        $id_sub_category = htmlspecialchars((int)strip_tags(trim((int)$id_sub_category)));

        $sql_query = "SELECT id_sub_category, name FROM sub_categories WHERE id_sub_category=? LIMIT 1;";
        $message["subcategory"] = $this->db->fetchRow($sql_query, [$id_sub_category]);

        if(empty($message["subcategory"])) {
            throw new Exception("Не удалось найти подкатегорию!");
        }

        $message["success"][] = "Категория успешно получена!";

        return $message;
    }

    public function addSubCategory(int $id_category, string $name)
    {
        $message["success"] = [];

        if ((empty($id_category)) || (empty($name))) {
            throw new Exception("Один или более передаваемых аргументов пусты!");
        }

        $id_category = htmlspecialchars((int)strip_tags(trim((int)$id_category)));
        $name = htmlspecialchars((string)strip_tags(trim((string)$name)));

        $sql_query = "INSERT INTO sub_categories(id_category, name) VALUES (?,?);";
        $this->db->query($sql_query, [$id_category, $name]);
        $message["success"][] = "Подкатегория успешно добавлена!";

        return $message;
    }

    public function changeSubCategory(int $id_sub_category, string $name)
    {
        $message["success"] = [];

        if ((empty($id_sub_category)) || (empty($name))) {
            throw new Exception("Один или более передаваемых аргументов пусты!");
        }

        $id_sub_category = htmlspecialchars((int)strip_tags(trim((int)$id_sub_category)));
        $name = htmlspecialchars((string)strip_tags(trim((string)$name)));

        $sql_query = "UPDATE sub_categories SET name=? WHERE id_sub_category=?;";
        $this->db->query($sql_query, [$name, $id_sub_category]);

        $message["success"][] = "Подкатегория успешно изменена!";

        return $message;
    }

    public function deleteSubCategory(int $id_sub_category)
    {
        $message["success"] = [];

        if (empty($id_sub_category)) {
            throw new Exception("Передаваемый аргумент пуст!");
        }

        $id_sub_category = htmlspecialchars((int)strip_tags(trim((int)$id_sub_category)));

        $sql_query = "DELETE FROM sub_categories WHERE id_sub_category=?;";
        $this->db->query($sql_query, [$id_sub_category]);
        $message["success"][] = "Подкатегория успешно удалена!";

        return $message;
    }


}