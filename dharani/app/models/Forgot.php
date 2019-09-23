<?php

class Forgot extends \Phalcon\Mvc\Model
{

    /**
     *
     * @var integer
     */
    public $id;

    /**
     *
     * @var string
     */
    public $gmail;

    /**
     *
     * @var string
     */
    public $encode;

    /**
     *
     * @var integer
     */
    public $status;

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
        $this->setSource("forgot");
    }

    /**
     * Returns table name mapped in the model.
     *
     * @return string
     */
    public function getSource()
    {
        return 'forgot';
    }

    /**
     * Allows to query a set of records that match the specified conditions
     *
     * @param mixed $parameters
     * @return Forgot[]|Forgot|\Phalcon\Mvc\Model\ResultSetInterface
     */
    public static function find($parameters = null)
    {
        return parent::find($parameters);
    }

    /**
     * Allows to query the first record that match the specified conditions
     *
     * @param mixed $parameters
     * @return Forgot|\Phalcon\Mvc\Model\ResultInterface
     */
    public static function findFirst($parameters = null)
    {
        return parent::findFirst($parameters);
    }

}
