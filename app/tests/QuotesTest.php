<?php

class QuotesTest extends TestCase {

	/**
	 * A basic functional test example.
	 *
	 * @return void
	 */
	public function testIndex()
	{
		// $crawler = $this->client->request('GET', '/');
		// $this->assertTrue($this->client->getResponse()->isOk());
		$response = $this->call('GET', 'quotes');
		$this->assertRedirectedTo('api/v1/quotes');
		$this->assertResponseStatus(200);
	}

}