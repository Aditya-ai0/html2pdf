<?php
/**
 * Created by JetBrains PhpStorm.
 * User: keshav
 * Date: 10/10/13
 * Time: 1:05 PM
 * To change this template use File | Settings | File Templates.
 */

class ConverterService
{

    private $converterRepo;

    public function __construct(ConverterRepositoryInterface $converterRepo)
    {
        $this->converterRepo = $converterRepo;
    }

    public function addConverter($name, $location, $status)
    {
        $converter = $this->getConverter(null, null, $location, null);
        if ($converter)
            throw new InvalidArgumentException("converter already exist at this location");
        return $this->converterRepo->addConverter($name, $location, $status);
    }

    public function getConverter($id = null, $name = null, $location = null, $status = null)
    {
        return $this->converterRepo->getConverter($id, $name, $location, $status);
    }


    public function getLock($id)
    {
        return $this->converterRepo->getLock($id);
    }

    public function releaseLock($id)
    {
        return $this->converterRepo->releaseLock($id);
    }

}