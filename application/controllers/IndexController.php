<?php

class IndexController extends Zend_Controller_Action
{

    public function init()
    {
        /* Initialize action controller here */
    }

    public function indexAction()
    {
       
    }
    public function searchAction(){

        $name = $this->_getParam('search');
        $template = new Application_Model_DbTable_Template();
        $this->view->template = $template->getTemplate($name);
        var_dump($template->getTemplate($name));exit;
        $where = array();
        $where[] = $name; // 1 could be a variable
        $result = $template->fetchAll($where);
    }
    public function viewAction(){
        $template = new Application_Model_DbTable_Template();
        $this->view->template = $template->fetchAll();
    }

    public function addAction()
    {
        $form = new Application_Form_Template();
        $form->submit->setLabel('Add');
        $this->view->form = $form;

        if($this->getRequest()->isPost()){
            $formData = $this->getRequest()->getPost();
            $form->submit->setLabel('Add');
            $this->view->form = $form;
            if($form->isValid($formData)){
                echo '<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css">';
                try {
                    $name = $form->getValue('name');
                    $controller = $form->getValue('controller');
                    $action = $form->getValue('action');
                    if(!$name || !$controller || !$action)
                        throw new Exception("Chưa nhập đủ thông tin");
                    $note = $form->getValue('note');
                    $file = $_FILES['file']['name'];
                    if (!$file)
                        throw new Exception("không có file");
                    $url = "files/" . $file;
                    $file_type= strtolower(pathinfo($url)['extension']);
                    $file_excep = ['xlsx', 'xlsm', 'xls', 'xltx', 'docs','docm','doc','docx'];
                        // if(!in_array($file_type,$file_excep)){
                        //     throw new Exception("Không được chuyền file nào khác ngoài file excel và worword vào");
                        // }
                    move_uploaded_file($_FILES["file"]['tmp_name'], $url);

                    $template = new Application_Model_DbTable_Template();

                    $template->insert(
                        array(
                            'name' => $name,
                            'controller' => $controller,
                            'action' => $action,
                            'note' => $note,
                            'file' => $file
                        )
                    );
                    exit('<div class="alert alert-success"><strong>Thành công!</strong></div>');
                } catch (Exception $e) {
                    exit('<div class="alert alert-danger">Có lỗi sảy ra: ' . $e->getMessage() . '</div>');
                }

                
                
            } else {
                $form->populate($formData);
                    }

        }
        }
    public function editAction()
    {
        $form = new Application_Form_Album();
        $form->submit->setLabel('Save');
        $this->view->form = $form;
        
        if ($this->getRequest()->isPost()) {
            $formData = $this->getRequest()->getPost();
            if ($form->isValid($formData)) {
                $id = (int)$form->getValue('id');
                $artist = $form->getValue('artist');
                $title = $form->getValue('title');
                $albums = new Application_Model_DbTable_Template();
                $albums->updateAlbum($id, $artist, $title);
                
                $this->_helper->redirector('index');
            } else {
                $form->populate($formData);
            }
        } else {
            $id = $this->_getParam('id', 0);
            if ($id > 0) {
                $albums = new Application_Model_DbTable_Template();
                $form->populate($albums->getAlbum($id));
            }
        }
        
    }

    public function deleteAction()
    {
        if ($this->getRequest()->isPost()) {
            $del = $this->getRequest()->getPost('del');
            if ($del == 'Yes') {
                $id = $this->getRequest()->getPost('id');
                $albums = new Application_Model_DbTable_Albums();
                $albums->deleteAlbum($id);
            }
            $this->_helper->redirector('index');
        } else {
            $id = $this->_getParam('id', 0);
            $albums = new Application_Model_DbTable_Albums();
            $this->view->album = $albums->getAlbum($id);
        }
    }


}






