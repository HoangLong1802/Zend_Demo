<?php

class Application_Model_DbTable_Template extends Zend_Db_Table_Abstract
{

    protected $_name = 'template';

    public function getTemplate($id)
    {
        $id = (int)$id;
        $row = $this->fetchRow('id = ' . $id);
        if (!$row) {
            throw new Exception("Could not find row $id");
        }
        return $row->toArray();
    }

    public function addTemplate($name, $controller, $action, $note)
    {
        $data = array(
            'name' => $name,
            'controller' => $controller,
            'action' => $action,
            'note' => $note,
        );
        $this->insert($data);
    }

    public function updateAlbum($id, $artist, $title)
    {
        $data = array(
            'artist' => $artist,
            'title' => $title,
        );
        $this->update($data, 'id = '. (int)$id);
    }

    public function deleteAlbum($id)
    {
        $this->delete('id =' . (int)$id);
    }

}

