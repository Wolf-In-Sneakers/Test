<?php


namespace Shop\models\Link;

use Exception;
use Shop\core\Model;

class Link extends Model
{

    public function addLink(int $id_material, string $link, string $name)
    {
        $message["success"] = [];

        if ((empty($id_material)) || (empty($link))) {
            throw new Exception("Один или более передаваемых аргументов пусты!");
        }

        $id_material = htmlspecialchars((int)strip_tags(trim((int)$id_material)));
        $link = htmlspecialchars((string)strip_tags(trim((string)$link)));
        $name = htmlspecialchars((string)strip_tags(trim((string)$name)));

        $sql_query = "INSERT INTO links(id_material, link, name) VALUES (?,?,?);";
        $this->db->query($sql_query, [$id_material, $link, $name]);
        $message["success"][] = "Ссылка успешно добавлена!";

        return $message;
    }

    public function listLinks(int $id_material)
    {
        $message["success"] = [];

        $sql_query = "SELECT * FROM links WHERE id_material=? ORDER BY created;";
        $message["links"] = $this->db->fetchAll($sql_query, [$id_material]);
        $message["success"][] = "Материалы успешно получены!";

        return $message;
    }

    public function changeLink(int $id_link, string $link, string $name)
    {
        $message["success"] = [];

        if ((empty($id_link)) || (empty($link))) {
            throw new Exception("Один или более передаваемых аргументов пусты!");
        }

        $id_link = htmlspecialchars((int)strip_tags(trim((int)$id_link)));
        $link = htmlspecialchars((string)strip_tags(trim((string)$link)));
        $name = htmlspecialchars((string)strip_tags(trim((string)$name)));


        $sql_query = "UPDATE links SET link=?, name=? WHERE id_link=?;";
        $this->db->query($sql_query, [$link, $name, $id_link]);

        $message["success"][] = "Ссылка успешно изменена!";

        return $message;
    }


    public function deleteLink(int $id_link)
    {
        $message["success"] = [];

        if (empty($id_link)) {
            throw new Exception("Передаваемый аргумент пуст!");
        }

        $id_link = htmlspecialchars((int)strip_tags(trim((int)$id_link)));

        $sql_query = "DELETE FROM links WHERE id_link=?;";
        $this->db->query($sql_query, [$id_link]);

        $message["success"][] = "Ссылка успешно удалена!";

        return $message;
    }

}