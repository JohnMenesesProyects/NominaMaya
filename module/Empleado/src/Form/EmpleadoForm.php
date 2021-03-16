<?php


namespace Ciudad\Form;

use Zend\Form\Form;

class EmpleadoForm
{

    public function __construct($name = null)
    {
        /* Modificar con los datos de la tabla empleado*/
        // We will ignore the name provided to the constructor
        parent::__construct('ciudad');

        $this->add([
            'name' => 'id_empleado',
            'type' => 'hidden',
        ]);
        $this->add([
            'name' => 'Nombre_Empleado',
            'type' => 'text',
            'options' => [
                'label' => 'Nombre_Empleado',
            ],
        ]);
        $this->add([
            'name' => 'ApellidoP',
            'type' => 'text',
            'options' => [
                'label' => 'ApellidoP',
            ],
        ]);

        $this->add([
            'name' => 'ApellidoM',
            'type' => 'text',
            'options' => [
                'label' => 'ApellidoM',
            ],
        ]);
        $this->add([
            'name' => 'Telefono',
            'type' => 'text',
            'options' => [
                'label' => 'Telefono',
            ],
        ]);

        $this->add([
            'name' => 'id_area_fk',
            'type' => 'text',
            'options' => [
                'label' => 'id_area_fk',
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