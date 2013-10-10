<?php
/**
 * Created by JetBrains PhpStorm.
 * User: keshav
 * Date: 9/10/13
 * Time: 6:56 PM
 * To change this template use File | Settings | File Templates.
 */

class EloquentConverterRepository implements ConverterRepository
{


    public function addConverter($name, $location, $status)
    {
        try {
            $converter = new Converter();
            $converter->name = $name;
            $converter->location = $location;
            $converter->status = $status;
            $converter->save();
            return $converter;
        } catch (Exception $e) {
            Log::error($e);
            throw $e;
        }

    }

    public function getConverter($id, $name, $location, $status)
    {
        try {
            $query = Converter::getQuery();
            if ($id)
                $query->where('id', '=', $id);
            if ($name)
                $query->where('name', '=', $name);
            if ($location)
                $query->where('location', '=', $location);
            if ($status)
                $query->where('status', '=', $status);
            return $query->first();
        } catch (Exception $e) {
            Log::error($e);
            throw $e;
        }

    }

    public function all()
    {
        // TODO: Implement all() method.
    }

    public function getConverterList($name, $location, $status)
    {
        // TODO: Implement getConverterList() method.
    }
}