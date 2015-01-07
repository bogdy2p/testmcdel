<?php

namespace MissionControl\Bundle\ProjectBundle;

use MissionControl\Bundle\ProjectBundle\DependencyInjection\Security\Factory\WsseFactory;
use Symfony\Component\HttpKernel\Bundle\Bundle;
use \Symfony\Component\DependencyInjection\ContainerBuilder;

class ProjectBundle extends Bundle
{
	public function build(ContainerBuilder $container){
		parent::build($container);

		$extension = $container->getExtension('security');
		$extension->addSecurityListenerFactory(new WsseFactory());
	}
}
