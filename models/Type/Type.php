<?php

namespace Shop\models\Type;

use Exception;
use Shop\core\Model;

class Type extends Model
{

    public function addType(string $name)
    {
        $message["success"] = [];

        if (empty($name)) {
            throw new Exception("Передаваемый аргумент пуст!");
        }

        $name = htmlspecialchars((string)strip_tags(trim((string)$name)));

        $sql_query = "INSERT INTO types(name) VALUES (?);";
        $this->db->query($sql_query, [$name]);
        $message["success"][] = "Тип успешно добавлен!";

        return $message;
    }

    public function listTypes()
    {
        $message["success"] = [];

        $sql_query = "SELECT id_type, name FROM types ORDER BY created;";
        $message["types"] = $this->db->fetchAll($sql_query);
        $message["success"][] = "Типы успешно получены!";

        return $message;
    }

    public function viewType(int $id_type)
    {
        $message["success"] = [];

        if (empty($id_type)) {
            throw new Exception("Передаваемый аргумент пуст!");
        }

        $id_type = htmlspecialchars((int)strip_tags(trim((int)$id_type)));

        $sql_query = "SELECT id_type, name FROM types WHERE id_type =? LIMIT 1;";
        $message["type"] = $this->db->fetchRow($sql_query, [$id_type]);

        if(empty($message["type"])){
            throw new Exception("Не удалось найти тип!");
        }

        $message["success"][] = "Тип успешно получен!";

        return $message;
    }

    public function changeType(int $id_type, string $name)
    {
        $message["success"] = [];

        if ((empty($id_type)) || (empty($name))) {
            throw new Exception("Один или более передаваемых аргументов пусты!");
        }

        $id_type = htmlspecialchars((int)strip_tags(trim((int)$id_type)));
        $name = htmlspecialchars((string)strip_tags(trim((string)$name)));

        $sql_query = "UPDATE types SET name =? WHERE id_type =?;";
        $this->db->query($sql_query, [$name, $id_type]);

        $message["success"][] = "Тип успешно изменен!";

        return $message;
    }

    public function deleteType(int $id_type)
    {
        $message["success"] = [];

        if (empty($id_type)) {
            throw new Exception("Передаваемый аргумент пуст!");
        }

        $id_type = htmlspecialchars((int)strip_tags(trim((int)$id_type)));

        $sql_query = "DELETE FROM types WHERE id_type =?;";
        $this->db->query($sql_query, [$id_type]);
        $message["success"][] = "Тип успешно удален!";

        return $message;
    }

}