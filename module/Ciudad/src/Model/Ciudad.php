<?php

namespace Ciudad\Model;

use DomainException;
use Zend\Filter\StringTrim;
use Zend\Filter\StripTags;
use Zend\Filter\ToInt;
use Zend\InputFilter\InputFilter;
use Zend\InputFilter\InputFilterAwareInterface;
use Zend\InputFilter\InputFilterInterface;
use Zend\Validator\StringLength;



class Ciudad implements InputFilterAwareInterface
{
    public $id_ciudad;
    public $nombre_ciudad;

    private $inputFilter;

    public function exchangeArray(array $data)
    {
        $this->id_ciudad     = !empty($data['id_ciudad']) ? $data['id_ciudad'] : null;
        $this->nombre_ciudad = !empty($data['nombre_ciudad']) ? $data['nombre_ciudad'] : null;
    }



    /*ELEMENTOS AGREGADOS */
    public function getArrayCopy()
    {
        return [
            'id_ciudad'     => $this->id_ciudad,
            'nombre_ciudad' => $this->nombre_ciudad,
        ];
    }



    public function setInputFilter(InputFilterInterface $inputFilter)
    {
        throw new DomainException(sprintf(
            '%s does not allow injection of an alternate input filter',
            __CLASS__
        ));
    }

    public function getInputFilter()
    {
        if ($this->inputFilter) {
            return $this->inputFilter;
        }

        $inputFilter = new InputFilter();

        $inputFilter->add([
            'name' => 'id_ciudad',
            'required' => true,
            'filters' => [
                ['name' => ToInt::class],
            ],
        ]);

        $inputFilter->add([
            'name' => 'nombre_ciudad',
            'required' => true,
            'filters' => [
                ['name' => StripTags::class],
                ['name' => StringTrim::class],
            ],
            'validators' => [
                [
                    'name' => StringLength::class,
                    'options' => [
                        'encoding' => 'UTF-8',
                        'min' => 1,
                        'max' => 100,
                    ],
                ],
            ],
        ]);


        $this->inputFilter = $inputFilter;
        return $this->inputFilter;
    }

}