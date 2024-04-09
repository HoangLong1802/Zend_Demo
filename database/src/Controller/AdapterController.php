<?php 
namespace Database\Controller;
use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;

class ViewController extends AbstractActionController{
    public function AdapterDB(){
        $adater = new AdapterDB([
            'driver'=>'Pdo_Mysql',
            'database'=>'zend_demo_db',
            'username'=>'root',
            'password'=>'',
            'hostname'=>'localhost',
            'charset'=>'utf8',
        ]);
        return $adater;
    }
    public function indexAction(){
        $database = $this->AdapterDB(); 

        $sql = 'SELECT * FROM `Staff`';
        $statement = $database->query($sql);

        $result = $statement->execute();

        print_r($result);

        return false;
    }
}