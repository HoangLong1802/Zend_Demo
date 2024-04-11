<?php

class Application_Model_DbTable_Template extends Zend_Db_Table_Abstract
{

    protected $_name = 'template';

    public function getTemplate($template)
    {
        try {
            $where = array();
            $where[] = $this->getAdapter()->quoteInto('name LIKE ?', $template);  // 1 could be a variable
        // $row = $this->fetchRow('name = '.$template);
            $result = $this->fetchAll($where);
        if (!$result) {
            throw new Exception("Could not find row");
        }
            return $result->toArray();
        
    } catch (Exception $e) {
            exit($e->getMessage());
        }}
        public function getTemplatebyID($id)
    {
        try {
            $where = array();
            $where[] = $this->getAdapter()->quoteInto('id = ?', $id);  // 1 could be a variable
        // $row = $this->fetchRow('name = '.$template);
            $result = $this->fetchAll($where);
        if (!$result) {
            throw new Exception("Could not find row");
        }
            return $result->toArray();
        
    }
    catch(Exception $e ){
        exit($e->getMessage());
    }}

    // public function addTemplate($name, $controller, $action, $note)
    // {
    //     $data = array(
    //         'name' => $name,
    //         'controller' => $controller,
    //         'action' => $action,
    //         'note' => $note,
    //     );
    //     $this->insert($data);
    // }

    // public function updateTemplate($id, $name, $controller, $action, $note, $file)
    // {   
    //     try {
    //     if($file){
    //             $data = array(
    //                 'id' => $id,
    //                 'name' => $name,
    //                 'controller' => $controller,
    //                 'action' => $action,
    //                 'note' => $note,
    //                 'file' => $file
    //             );
    //     }
    //     else{
    //             $data = array(
    //                 'id' => $id,
    //                 'name' => $name,
    //                 'controller' => $controller,
    //                 'action' => $action,
    //                 'note' => $note
    //             );
            
    //     }
    //     $this->update($data, 'id = '. (int)$id);
    // }
    // catch (Exception $e){
    //     exit($e->getMessage());
    // }
    // }

    public function deleteTemplate($id)
    {
        $this->delete('id =' . (int)$id);
    }

}

