<?php

class ApartmentsTest extends TestCase
{
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
        $this->seeJsonStructure([
            'id',
            'name',
            'status',
        ]);
    }
}
