<?php

// ------------------------------------------------------------
// Error Handlers
// ------------------------------------------------------------

App::error(function(Exception $exception, $code)
{
	Log::error($exception);
});

// General HttpException handler
App::error(function(Symfony\Component\HttpKernel\Exception\HttpException $e, $code)
{
	$headers = $e->getHeaders();

	switch ($code)
	{
		case 401:
			$defaultMessage = Lang::get('responseMessages.invalidApiKey');

		break;

		case 403:
			$defaultMessage = Lang::get('responseMessages.unauthorisedAccess');

		break;

		case 404:
            $defaultMessage = Lang::get('responseMessages.resourceNotFound');
		break;

		default:
			$defaultMessage = Lang::get('responseMessages.error');
	}

	return Response::json(array(
		'error' => $e->getMessage() ?: $defaultMessage,
	), $code, $headers);
});

// ErrorMessageException handler
App::error(function(ErrorMessageException $e)
{
	$messages = $e->getMessages()->all();

	return Response::json(array(
		'error' => $messages[0],
	), 400);
});

// NotFoundException handler
App::error(function(NotFoundException $e)
{
	$default_message = Lang::get('responseMessages.resourceNotFound');

	return Response::json(array(
		'error' => $e->getMessage() ?: $default_message,
	), 404);
});

// PermissionException handler
App::error(function(PermissionException $e)
{
	$default_message =  Lang::get('responseMessages.unauthorisedAccess');

	return Response::json(array(
		'error' => $e->getMessage() ?: $default_message,
	), 403);
});