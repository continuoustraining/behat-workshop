<?php

/**
 * Defines application features from the specific context.
 */
class FeatureContext implements \Behat\Behat\Context\Context
{
    protected $zf2MvcApplication;

    /**
     * Initializes context.
     *
     * Every scenario gets it's own context object.
     * You can also pass arbitrary arguments to the context constructor through behat.yml.
     */
    public function __construct()
    {
        require_once(__DIR__ . '/../../vendor/autoload.php');

        ini_set('memory_limit', '-1');

        $this->zf2MvcApplication = \Zend\Mvc\Application::init(require __DIR__ . '/../../config/application.config.php');
    }

    /**
     * @return \Doctrine\ORM\EntityManager
     */
    public function getEntityManager()
    {
        return $this->getServiceManager()->get('entity_manager');
    }

    public function getServiceManager()
    {
        return $this->zf2MvcApplication->getServiceManager();
    }

    /**
     * @BeforeScenario
     */
    public function purgeDatabase()
    {
        $purger = new \Doctrine\Common\DataFixtures\Purger\ORMPurger($this->getEntityManager());
        $purger->purge();
    }
}
