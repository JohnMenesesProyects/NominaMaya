<?php

namespace Ciudad\Controller;
use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;
use Ciudad\Model\CiudadTable;

use Ciudad\Form\CiudadForm;
use Ciudad\Model\Ciudad;

class CiudadController extends AbstractActionController
{

    private $table;

    public function __construct(CiudadTable $table)
    {
        $this->table = $table;
    }


    public function indexAction()
    {
        return new ViewModel([
            'ciudades' => $this->table->fetchAll(),
        ]);
    }



    public function editAction()
    {
        $id = (int) $this->params()->fromRoute('id_ciudad', 0);

        if (0 === $id) {
            return $this->redirect()->toRoute('ciudad', ['action' => 'add']);
        }

        // Retrieve the album with the specified id. Doing so raises
        // an exception if the album is not found, which should result
        // in redirecting to the landing page.
        try {
            $ciudad = $this->table->getCiudad($id);
        } catch (\Exception $e) {
            return $this->redirect()->toRoute('ciudad', ['action' => 'index']);
        }

        $form = new CiudadForm();
        $form->bind($ciudad);
        $form->get('submit')->setAttribute('value', 'Edit');

        $request = $this->getRequest();
        $viewData = ['id_ciudad' => $id, 'form' => $form];

        if (! $request->isPost()) {
            return $viewData;
        }

        $form->setInputFilter($ciudad->getInputFilter());
        $form->setData($request->getPost());

        if (! $form->isValid()) {
            return $viewData;
        }

        $this->table->saveCiudad($ciudad);

        // Redirect to album list
        return $this->redirect()->toRoute('ciudad', ['action' => 'index']);
    }

    public function addAction()
    {
        $form = new CiudadForm();
        $form->get('submit')->setValue('Add');

        $request = $this->getRequest();

        if (! $request->isPost()) {
            return ['form' => $form];
        }

        $ciudad = new Ciudad();
        $form->setInputFilter($ciudad->getInputFilter());
        $form->setData($request->getPost());

        if (! $form->isValid()) {
            return ['form' => $form];
        }

        $ciudad->exchangeArray($form->getData());
        $this->table->saveCiudad($ciudad);
        return $this->redirect()->toRoute('ciudad');
    }


    public function deleteAction()
    {
    }



}

