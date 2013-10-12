<?php
/**
 * Created by JetBrains PhpStorm.
 * User: keshav
 * Date: 12/10/13
 * Time: 12:32 PM
 * To change this template use File | Settings | File Templates.
 */

class ConverterController extends BaseController
{

    private $converterService;

    public function __construct(ConverterService $converterService)
    {
        $this->converterService = $converterService;
    }


    public function postAdd()
    {
        $location = Input::get('location', null);

        if (is_null($location))
            App::abort(400, Lang::get('responseMessages.badRequest'));
        $name = Input::get('name', $location);
        try {

            $converter = $this->converterService->addConverter($name, $location, false);
            return Response::json($converter);
        } catch (InvalidArgumentException $e) {
            return Response::json(array('error' => $e->getMessage()));
        } catch (Exception $e) {
            return Response::json(array('error' => Lang::get('responseMessages.internalServer')), 500);
        }


    }
}