<?php


namespace Ciudad\Form;

use Zend\Form\Form;

class CiudadForm extends Form
{
    public function __construct($name = null)
    {
        // We will ignore the name provided to the constructor
        parent::__construct('ciudad');

        $this->add([
            'name' => 'id_ciudad',
            'type' => 'hidden',
        ]);
        $this->add([
            'name' => 'nombre_ciudad',
            'type' => 'text',
            'options' => [
                'label' => 'Ciudad',
            ],
        ]);
        $this->add([
            'name' => 'submit',
            'type' => 'submit',
            'attributes' => [
                'value' => 'Go',
                'id'    => 'submitbutton',
            ],
        ]);
    }
}