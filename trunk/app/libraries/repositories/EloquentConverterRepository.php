<?php
/**
 * Created by JetBrains PhpStorm.
 * User: keshav
 * Date: 9/10/13
 * Time: 6:56 PM
 * To change this template use File | Settings | File Templates.
 */

class EloquentConverterRepositoryInterface implements ConverterRepositoryInterface
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

    public function updateConverter($id, $name, $location, $status)
    {
        try {
            $converter = Converter::where('id', '=', $id)->first();
            if ($name)
                $converter->name = $name;
            if ($location)
                $converter->location = $location;
            if ($status)
                $converter->status = $status;
            return $converter->save();
        } catch (Exception $e) {
            Log::error($e);
            throw $e;
        }

    }

    /**
     * updates converter status to running.
     * @param $id
     * @throws Exception
     *
     */
    public function getLock($id)
    {
        try {
            $currentObject = $this;
            DB::transaction(function () use ($id, $currentObject) {
                $currentObject->updateConverter($id, null, null, ConverterStatuses::BUSY);
            });
        } catch (Exception $e) {
            throw $e;
        }

    }

    /**
     * Updates Converter Status to Idle
     * @param $id
     * @throws Exception
     */
    public function releaseLock($id)
    {
        try {
            $currentObject = $this;
            DB::transaction(function () use ($id, $currentObject) {
                $currentObject->updateConverter($id, null, null, ConverterStatuses::IDLE);
            });
        } catch (Exception $e) {
            throw $e;
        }
    }
}