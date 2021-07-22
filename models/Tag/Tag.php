<?php

namespace Shop\models\Tag;

use Exception;
use Shop\core\Model;

class Tag extends Model
{

    public function addTag(string $name)
    {
        $message["success"] = [];

        if (empty($name)) {
            throw new Exception("Передаваемый аргумент пуст!");
        }

        $name = htmlspecialchars((string)strip_tags(trim((string)$name)));

        $sql_query = "INSERT INTO tags(name) VALUES (?);";
        $this->db->query($sql_query, [$name]);
        $message["success"][] = "Тег успешно добавлен!";

        return $message;
    }

    public function listTags()
    {
        $message["success"] = [];

        $sql_query = "SELECT id_tag, name FROM tags ORDER BY created;";
        $message["tags"] = $this->db->fetchAll($sql_query);
        $message["success"][] = "Теги успешно получены!";

        return $message;
    }

    public function viewTag(int $id_tag)
    {
        $message["success"] = [];

        if (empty($id_tag)) {
            throw new Exception("Передаваемый аргумент пуст!");
        }

        $id_tag = htmlspecialchars((int)strip_tags(trim((int)$id_tag)));

        $sql_query = "SELECT id_tag, name FROM tags WHERE id_tag =? LIMIT 1;";
        $message["tag"] = $this->db->fetchRow($sql_query, [$id_tag]);

        if (empty($message["tag"])) {
            throw new Exception("Не удалось найти тег!");
        }

        $message["success"][] = "Тег успешно получен!";

        return $message;
    }

    public function changeTag(int $id_tag, string $name)
    {
        $message["success"] = [];

        if ((empty($id_tag)) || (empty($name))) {
            throw new Exception("Один или более передаваемых аргументов пусты!");
        }

        $id_tag = htmlspecialchars((int)strip_tags(trim((int)$id_tag)));
        $name = htmlspecialchars((string)strip_tags(trim((string)$name)));

        $sql_query = "UPDATE tags SET name =? WHERE id_tag =?;";
        $this->db->query($sql_query, [$name, $id_tag]);

        $message["success"][] = "Тег успешно изменен!";

        return $message;
    }

    public function deleteTag(int $id_tag)
    {
        $message["success"] = [];

        if (empty($id_tag)) {
            throw new Exception("Передаваемый аргумент пуст!");
        }

        $id_tag = htmlspecialchars((int)strip_tags(trim((int)$id_tag)));

        $sql_query = "DELETE FROM tags WHERE id_tag =?;";
        $this->db->query($sql_query, [$id_tag]);
        $message["success"][] = "Тег успешно удален!";

        return $message;
    }

}