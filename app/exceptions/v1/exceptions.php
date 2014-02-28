<?php
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class CustomException extends NotFoundHttpException {

}

class NotAllowedException extends Exception {

}

?>