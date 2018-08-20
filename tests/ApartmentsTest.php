<?php

class ApartmentsTest extends TestCase
{
    private $outPutStoreData = [
        'id',
        'name',
        'status',
    ];

    private $parameters = [
        'name'   => 'หอพัก Testers',
        'status' => 'new_apartment',
    ];

    /**
     * /apartments/create
     */

    public function testShouldCreateApartment()
    {

        $this->post('apartments/create', $this->parameters, []);
        $this->seeStatusCode(201);
        $this->seeJsonStructure($this->outPutStoreData);
    }

    /**
     * @depends testShouldCreateApartment
     * /apartments/update
     */

    public function testShouldUpdateApartment()
    {
        $this->parameters['id'] = 1;
        $this->parameters['status'] = 'active_apartment';

        $this->put('apartments/update', $this->parameters, []);
        $this->seeStatusCode(200);
        $this->seeJsonStructure($this->outPutStoreData);
    }
}
