<?php

	/**
	 * Shopware 5 Plugin
	 * Controller
	 * Copyright @ 
	 * Juliane Anders
	 * http://store.shopware.com
	 */

namespace gwenMoveMenubar\Subscriber\Frontend;

use Enlight\Event\SubscriberInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;

class Controller implements SubscriberInterface {

  /**
   * @var type ContainerInterface
   */
  private $container;
  
  /**
   * @var type \Enlight_Plugin_Bootstrap_Config
   */
  private $pluginConfig;

  /**
   * @param ContainerInterface $container
   */
  public function __construct(ContainerInterface $container){
    $this->container = $container;
    $this->pluginConfig = $this->container->get('shopware.plugin.cached_config_reader')->getByPluginName('gwenMoveMenubar', $this->container->get('Shop'));
  }

  /**
   * subscriber events
   * @return type
   */
  public static function getSubscribedEvents() {
    return [
      'Enlight_Controller_Action_PostDispatchSecure_Frontend' => 'onPostDispatchFrontend',
    ];
  }

  /**
   * @param \Enlight_Event_EventArgs $args
   * @return type
   */
  public function onPostDispatchFrontend(\Enlight_Event_EventArgs $args) {
    $view = $args->getSubject()->View();
    $request = $args->getSubject()->Request();
    $response = $args->getSubject()->Response();

    //Check if there is a template and if an exception has occured
    if(!$request->isDispatched()||$response->isException()||!$view->hasTemplate()) {
      return;
    }

    /**
     * Check the availability of the plugin for the current store
     */
    if(!$this->pluginConfig['gwen_move_menubar_io']) {
      return;
    }
    
    /**
     * Check if menubar are in the header
     */
    if($this->pluginConfig['gwen_move_menubar']) {
      $view->assign('gwen_move_menubar', $this->pluginConfig['gwen_move_menubar'] );
    }
    
    /**
     * Check if breadcrumbs are disabled
     */
    if($this->pluginConfig['gwen_disabled_breadcrumbs']) {
      $view->assign('gwen_disabled_breadcrumbs', $this->pluginConfig['gwen_disabled_breadcrumbs'] );
    }

    /**
     * Add template to the directory plugin
     */
    $view->addTemplateDir($this->container->getParameter('gwen_move_menubar.plugin_dir') . '/Resources/Views');
  }
}