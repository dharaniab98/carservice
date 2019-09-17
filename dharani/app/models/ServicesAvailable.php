<?php

class ServicesAvailable extends \Phalcon\Mvc\Model
{

    /**
     *
     * @var integer
     */
    public $service_id;

    /**
     *
     * @var string
     */
    public $service_name;

    /**
     *
     * @var integer
     */
    public $basic_service_cost;

    /**
     * Initialize method for model.
     */
    public function initialize()
    {
        $this->setSchema("mydata");
        $this->setSource("services_available");
    }

    /**
     * Returns table name mapped in the model.
     *
     * @return string
     */
    public function getSource()
    {
        return 'services_available';
    }

    /**
     * Allows to query a set of records that match the specified conditions
     *
     * @param mixed $parameters
     * @return ServicesAvailable[]|ServicesAvailable|\Phalcon\Mvc\Model\ResultSetInterface
     */
    public static function find($parameters = null)
    {
        return parent::find($parameters);
    }

    /**
     * Allows to query the first record that match the specified conditions
     *
     * @param mixed $parameters
     * @return ServicesAvailable|\Phalcon\Mvc\Model\ResultInterface
     */
    public static function findFirst($parameters = null)
    {
        return parent::findFirst($parameters);
    }

}