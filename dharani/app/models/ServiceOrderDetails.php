<?php

class ServiceOrderDetails extends \Phalcon\Mvc\Model
{

    /**
     *
     * @var integer
     */
    public $order_id;

    /**
     *
     * @var integer
     */
    public $eng_extra_cost;

    /**
     *
     * @var integer
     */
    public $wash_extra_cost;

    /**
     *
     * @var string
     */
    public $remarks;

    /**
     *
     * @var integer
     */
    public $status;

    /**
     *
     * @var integer
     */
    public $eng_id;

    /**
     *
     * @var integer
     */
    public $wash_id;

    /**
     *
     * @var integer
     */
    public $car_id;

    /**
     *
     * @var string
     */
    public $md_date;

    /**
     *
     * @var string
     */
    public $cr_date;

    /**
     * Initialize method for model.
     */
    public function initialize()
    {
        $this->setSchema("mydata");
        $this->setSource("service_order_details");
    }

    /**
     * Returns table name mapped in the model.
     *
     * @return string
     */
    public function getSource()
    {
        return 'service_order_details';
    }

    /**
     * Allows to query a set of records that match the specified conditions
     *
     * @param mixed $parameters
     * @return ServiceOrderDetails[]|ServiceOrderDetails|\Phalcon\Mvc\Model\ResultSetInterface
     */
    public static function find($parameters = null)
    {
        return parent::find($parameters);
    }

    /**
     * Allows to query the first record that match the specified conditions
     *
     * @param mixed $parameters
     * @return ServiceOrderDetails|\Phalcon\Mvc\Model\ResultInterface
     */
    public static function findFirst($parameters = null)
    {
        return parent::findFirst($parameters);
    }

}