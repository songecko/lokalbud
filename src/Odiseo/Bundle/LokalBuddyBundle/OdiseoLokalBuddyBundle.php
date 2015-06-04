<?php

namespace Odiseo\Bundle\LokalBuddyBundle;

use Symfony\Component\HttpKernel\Bundle\Bundle;

class OdiseoLokalBuddyBundle extends Bundle
{
	public function getParent()
	{
		return 'SyliusWebBundle';
	}
}
