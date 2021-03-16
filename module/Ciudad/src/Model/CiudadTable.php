<?php

namespace Ciudad\Model;

use RuntimeException;
use Zend\Db\TableGateway\TableGatewayInterface;

class CiudadTable
{
    private $tableGateway;

    public function __construct(TableGatewayInterface $tableGateway)
    {
        $this->tableGateway = $tableGateway;
    }

    public function fetchAll()
    {
        return $this->tableGateway->select();
    }

    public function getCiudad($id)
    {
        $id_ciudad = (int) $id_ciudad;
        $rowset = $this->tableGateway->select(['id_ciudad' => $id_ciudad]);
        $row = $rowset->current();
        if (! $row) {
            throw new RuntimeException(sprintf(
                'Could not find row with identifier %d',
                $id_ciudad
            ));
        }

        return $row;
    }

    public function saveCiudad(Ciudad $ciudad)
    {
        $data = [
            'nombre_ciudad' => $ciudad->nombre_ciudad,
        ];

        $id_ciudad = (int) $ciudad->id_ciudad;

        if ($id_ciudad === 0) {
            $this->tableGateway->insert($data);
            return;
        }

        try {
            $this->getCiudad($id_ciudad);
        } catch (RuntimeException $e) {
            throw new RuntimeException(sprintf(
                'Cannot update ciudad with identifier %d; does not exist',
                $id_ciudad
            ));
        }

        $this->tableGateway->update($data, ['id_ciudad' => $id_ciudad]);
    }

    public function deleteCiudad($id)
    {
        $this->tableGateway->delete(['id_ciudad' => (int) $id_ciudad]);
    }
}