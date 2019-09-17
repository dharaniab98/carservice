<?php

class CarDetails extends \Phalcon\Mvc\Model
{

    /**
     *
     * @var integer
     */
    public $car_id;

    /**
     *
     * @var string
     */
    public $car_license_number;

    /**
     *
     * @var string
     */
    public $car_chesis_number;

    /**
     *
     * @var string
     */
    public $car_battery_number;

    /**
     *
     * @var string
     */
    public $car_color;

    /**
     *
     * @var string
     */
    public $car_model_name;

    /**
     *
     * @var string
     */
    public $car_make;

    

    /**
     *
     * @var integer
     */
    public $car_fuel_level;

    /**
     *
     * @var string
     */
    public $car_body_description;

    /**
     *
     * @var string
     */
    public $user_complaints;

    /**
     *
     * @var integer
     */
    public $owner_id;

    /**
     *
     * @var string
     */
    public $car_cr_date;

    /**
     * Initialize method for model.
     */
    public function initialize()
    {
        $this->setSchema("mydata");
        $this->setSource("car_details");
    }

    /**
     * Returns table name mapped in the model.
     *
     * @return string
     */
    public function getSource()
    {
        return 'car_details';
    }

    /**
     * Allows to query a set of records that match the specified conditions
     *
     * @param mixed $parameters
     * @return CarDetails[]|CarDetails|\Phalcon\Mvc\Model\ResultSetInterface
     */
    public static function find($parameters = null)
    {
        return parent::find($parameters);
    }

    /**
     * Allows to query the first record that match the specified conditions
     *
     * @param mixed $parameters
     * @return CarDetails|\Phalcon\Mvc\Model\ResultInterface
     */
    public static function findFirst($parameters = null)
    {
        return parent::findFirst($parameters);
    }

}
