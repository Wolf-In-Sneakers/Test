<?php


namespace Shop\models\Material;

use Exception;
use Shop\core\Model;

class Material extends Model
{

    public function addMaterial(string $name, int $id_category, int $id_type, string $author, string $description)
    {
        $message["success"] = [];

        if ((empty($id_category)) || (empty($name))) {
            throw new Exception("Один или более передаваемых аргументов пусты!");
        }

        $name = htmlspecialchars((string)strip_tags(trim((string)$name)));
        $id_type = htmlspecialchars((int)strip_tags(trim((int)$id_type)));
        $id_category = htmlspecialchars((int)strip_tags(trim((int)$id_category)));
        $author = htmlspecialchars((string)strip_tags(trim((string)$author)));
        $description = htmlspecialchars((string)strip_tags(trim((string)$description)));


        $sql_query = "INSERT INTO materials(name, id_sub_category, id_type, author, description) VALUES (?,?,?,?,?);";
        $this->db->query($sql_query, [$name, $id_category, $id_type, $author, $description]);
        $message["success"][] = "Материал успешно добавлен!";

        return $message;
    }

    public function addTagToMaterial(int $id_material, int $id_tag)
    {
        $message["success"] = [];

        if ((empty($id_material)) || (empty($id_tag))) {
            throw new Exception("Один или более передаваемых аргументов пусты!");
        }

        $id_material = htmlspecialchars((int)strip_tags(trim((int)$id_material)));
        $id_tag = htmlspecialchars((int)strip_tags(trim((int)$id_tag)));

        $sql_query = "SELECT * FROM materials_tags WHERE id_material=? AND id_tag=? LIMIT 1;";
        $answer = $this->db->fetchRow($sql_query, [$id_material, $id_tag]);

        if (!empty($answer)) {
            throw new Exception("Такой тег уже есть!");
        }

        $sql_query = "INSERT INTO materials_tags(id_material, id_tag) VALUES (?,?);";
        $this->db->query($sql_query, [$id_material, $id_tag]);
        $message["success"][] = "Тег успешно добавлен!";

        return $message;
    }

    public function listMaterials()
    {
        $message["success"] = [];

        $sql_query = "SELECT m.id_material, m.name, CONCAT(c.name,'/',sc.name) as category, t.name as type, m.author, m.description FROM materials m
                        INNER JOIN sub_categories sc ON m.id_sub_category = sc.id_sub_category
                        INNER JOIN categories c ON sc.id_category = c.id_category
                        INNER JOIN types t ON m.id_type = t.id_type
                        ORDER BY m.created;";
        $message["materials"] = $this->db->fetchAll($sql_query);
        $message["success"][] = "Материалы успешно получены!";

        return $message;
    }

    public function viewMaterial(int $id_material)
    {
        $message["success"] = [];

        if (empty($id_material)) {
            throw new Exception("Передаваемый аргумент пуст!");
        }

        $id_material = htmlspecialchars((int)strip_tags(trim((int)$id_material)));

        $sql_query = "SELECT m.id_material, m.name, sc.id_sub_category as id_category, CONCAT(c.name,'/',sc.name) as category, t.id_type, t.name as type, m.author, m.description FROM materials m
                        INNER JOIN sub_categories sc ON m.id_sub_category = sc.id_sub_category
                        INNER JOIN categories c ON sc.id_category = c.id_category
                        INNER JOIN types t ON m.id_type = t.id_type
                        WHERE m.id_material=? LIMIT 1;";
        $message["material"] = $this->db->fetchRow($sql_query, [$id_material]);

        if (empty($message["material"])) {
            throw new Exception("Не удалось найти материал!");
        }

        $message["success"][] = "Материал успешно получен!";

        return $message;
    }

    public function searchMaterials(string $search)
    {
        $message["success"] = [];

        if (empty($search)) {
            throw new Exception("Передаваемый аргумент пуст!");
        }

        $search = htmlspecialchars((string)strip_tags(trim((string)$search)));

        $sql_query = "SELECT m.id_material, m.name, CONCAT(c.name,'/',sc.name) as category, m.author FROM materials m
                        INNER JOIN sub_categories sc ON m.id_sub_category = sc.id_sub_category
                        INNER JOIN categories c ON sc.id_category = c.id_category
                        LEFT JOIN materials_tags mt ON m.id_material = mt.id_material
                        LEFT JOIN tags t ON mt.id_tag = t.id_tag
                        WHERE m.name LIKE '%$search%' OR c.name LIKE '%$search%' OR sc.name LIKE '%$search%' OR t.name LIKE '%$search%' OR m.author LIKE '%$search%'
                         GROUP BY m.id_material, m.created ORDER BY m.created;";
        $message["materials"] = $this->db->fetchAll($sql_query);

        $message["success"][] = "Материалы успешно получены!";

        return $message;
    }

    public function listTagsMaterial(int $id_material)
    {
        $message["success"] = [];

        if (empty($id_material)) {
            throw new Exception("Передаваемый аргумент пуст!");
        }

        $id_material = htmlspecialchars((int)strip_tags(trim((int)$id_material)));

        $sql_query = "SELECT t.id_tag, t.name FROM tags t
                        INNER JOIN materials_tags mt ON mt.id_tag = t.id_tag
                        INNER JOIN materials m ON mt.id_material = m.id_material
                        WHERE m.id_material=?;";
        $message["tags"] = $this->db->fetchAll($sql_query, [$id_material]);
        $message["success"][] = "Теги успешно получены!";

        return $message;
    }

    public function searchMaterialToTag(int $id_tag)
    {
        $message["success"] = [];

        if (empty($id_tag)) {
            throw new Exception("Передаваемый аргумент пуст!");
        }

        $id_tag = htmlspecialchars((int)strip_tags(trim((int)$id_tag)));

        $sql_query = "SELECT m.id_material, m.name, CONCAT(c.name,'/',sc.name) as category, t.name as type, m.author, m.description FROM materials m
                        INNER JOIN sub_categories sc ON m.id_sub_category = sc.id_sub_category
                        INNER JOIN categories c ON sc.id_category = c.id_category
                        INNER JOIN types t ON m.id_type = t.id_type
                        INNER JOIN materials_tags mt ON m.id_material = mt.id_material
                        WHERE mt.id_tag=?
                        ORDER BY m.created;";
        $message["materials"] = $this->db->fetchAll($sql_query, [$id_tag]);
        $message["success"][] = "Материалы успешно получены!";

        return $message;
    }

    public function changeMaterial(int $id_material, string $name, int $id_category, int $id_type, string $author, string $description)
    {
        $message["success"] = [];

        if ((empty($id_material)) || (empty($name))) {
            throw new Exception("Один или более передаваемых аргументов пусты!");
        }

        $id_material = htmlspecialchars((int)strip_tags(trim((int)$id_material)));
        $name = htmlspecialchars((string)strip_tags(trim((string)$name)));
        $id_category = htmlspecialchars((int)strip_tags(trim((int)$id_category)));
        $id_type = htmlspecialchars((int)strip_tags(trim((int)$id_type)));
        $author = htmlspecialchars((string)strip_tags(trim((string)$author)));
        $description = htmlspecialchars((string)strip_tags(trim((string)$description)));


        $sql_query = "UPDATE materials SET name=?, id_sub_category=?, id_type=?, author=?, description=? WHERE id_material=?;";
        $this->db->query($sql_query, [$name, $id_category, $id_type, $author, $description, $id_material]);

        $message["success"][] = "Материал успешно изменен!";

        return $message;
    }

    public function deleteTagFromMaterial(int $id_material, int $id_tag)
    {
        $message["success"] = [];

        if ((empty($id_material)) || (empty($id_tag))) {
            throw new Exception("Один или более передаваемых аргументов пусты!");
        }

        $id_material = htmlspecialchars((int)strip_tags(trim((int)$id_material)));
        $id_tag = htmlspecialchars((int)strip_tags(trim((int)$id_tag)));


        $sql_query = "DELETE FROM materials_tags WHERE id_material=? AND id_tag=?;";
        $this->db->query($sql_query, [$id_material, $id_tag]);

        $message["success"][] = "Тег из материалов успешно удален!";

        return $message;
    }

    public function deleteMaterial(int $id_material)
    {
        $message["success"] = [];

        if (empty($id_material)) {
            throw new Exception("Передаваемый аргумент пуст!");
        }

        $id_material = htmlspecialchars((int)strip_tags(trim((int)$id_material)));

        $sql_query = "DELETE FROM materials WHERE id_material=?;";
        $this->db->query($sql_query, [$id_material]);

        $message["success"][] = "Материал успешно удален!";

        return $message;
    }

}