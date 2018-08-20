<?php

class ApartmentsTest extends TestCase
{
    private $outPutStoreData = [
        'id',
        'name',
        'status',
    ];

    /**
     * /apartments/create
     */

    public function testShouldCreateApartment()
    {
        $parameters = [
            'name'   => 'หอพัก Testers',
            'status' => 'new_apartment',
        ];

        $this->post('apartments/create', $parameters, []);
        $this->seeStatusCode(201);
        $this->seeJsonStructure($this->outPutStoreData);
    }

    /**
     * @depends testShouldCreateApartment
     */

    public function testShouldUpdateApartment()
    {
        $parameters = [
            'id'     => 1,
            'name'   => 'หอพัก Testers',
            'status' => 'active_apartment',
        ];

        $this->put('apartments/update', $parameters, []);
        $this->seeStatusCode(200);
        $this->seeJsonStructure($this->outPutStoreData);
    }
}
