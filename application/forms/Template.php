<?php

class Application_Form_Template extends Zend_Form
{
    public function init()
    {
        $this->setName('template');

        $id = new Zend_Form_Element_Hidden('id');
        $id->addFilter('Int');

        $name = new Zend_Form_Element_Text('name');
        $name ->setLabel('name')
               ->setRequired(true)
               ->addFilter('StripTags')
               ->addFilter('StringTrim')
               ->addValidator('NotEmpty');

        $controller = new Zend_Form_Element_Text('controller');
        $controller ->setLabel('controller')
              ->addFilter('StripTags')
              ->addFilter('StringTrim')
              ->addValidator('NotEmpty');

        $action = new Zend_Form_Element_Text('action');
        $action->setLabel('action')
            ->addFilter('StripTags')
            ->addFilter('StringTrim')
            ->addValidator('NotEmpty');

        $note = new Zend_Form_Element_Text('note');
        $note->setLabel('note')
            ->addFilter('StripTags')
            ->addFilter('StringTrim')
            ->addValidator('NotEmpty');
            
        $submit = new Zend_Form_Element_Submit('submit');
        $submit->setAttrib('id', 'submitbutton');

        $this->addElements(array($id, $name, $controller, $action, $note, $submit));
    }
}?>