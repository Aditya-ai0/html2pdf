<?php
/**
 * Created by JetBrains PhpStorm.
 * User: keshav
 * Date: 9/10/13
 * Time: 6:56 PM
 * To change this template use File | Settings | File Templates.
 */

class EloquentConverterRepository implements ConverterRepositoryInterface
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
            $query = Converter::query();
            if (!is_null($id))
                $query->where('id', '=', $id);
            if (!is_null($name))
                $query->where('name', '=', $name);
            if (!is_null($location))
                $query->where('location', '=', $location);
            if (!is_null($status))
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
            if (!is_null($name))
                $converter->name = $name;
            if (!is_null($location))
                $converter->location = $location;
            if (!is_null($status))
                $converter->status = $status;
            $converter->save();
            return $converter;
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
            return DB::transaction(function () use ($id, $currentObject) {
                return $currentObject->updateConverter($id, null, null, ConverterStatuses::BUSY);
            });
        } catch (Exception $e) {
            Log::error($e);
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
            return DB::transaction(function () use ($id, $currentObject) {
                return $currentObject->updateConverter($id, null, null, ConverterStatuses::IDLE);
            });
        } catch (Exception $e) {
            Log::error($e);
            throw $e;
        }
    }
}