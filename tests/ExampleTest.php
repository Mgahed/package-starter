<?php

namespace Mgahed\MgahedStarter\Tests;

class ExampleTest extends TestCase
{
	public function testMgahedStarterExample()
	{
		$this->get(route('mgahed-starter.index'))
			->assertStatus(200)
			->assertViewIs('mgahed-starter::index');
	}
}
