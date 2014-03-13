<?php

class OrdersTest extends TestCase {

	/**
	 * A basic functional test example.
	 *
	 * @return void
	 */
	public function testIndex() {
		$api_ver = 'api/v1/';
		// $crawler = $this->client->request('GET', '/');
		// $this->assertTrue($this->client->getResponse()->isOk());
		$response = $this->call('GET', 'orders');
		$this->assertRedirectedTo($api_ver.'orders');
		$this->assertResponseStatus(302);

		$this->assertRedirectedToAction('OrdersController@index');
		$response = $this->call('GET', $api_ver.'orders');
		$this->assertResponseStatus(200);
	}

}