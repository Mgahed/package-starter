<?php

namespace Mgahed\MgahedStarter\Commands;

use Illuminate\Console\Command;

class MgahedStarterCommand extends Command
{
	public $signature = 'test-starter';

	public $description = 'My command';

	public function handle(): int
	{
		$this->comment('All done');

		return self::SUCCESS;
	}
}
