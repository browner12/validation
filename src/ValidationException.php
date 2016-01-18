<?php namespace browner12\validation;

use Exception;
use Illuminate\Contracts\Support\MessageBag;

class ValidationException extends Exception
{
    /**
     * @var string
     */
    protected $title = 'Error';

    /**
     * @var string
     */
    protected $body = 'Please correct the following errors:';

    /**
     * @var \Illuminate\Contracts\Support\MessageBag
     */
    protected $errors;

    /**
     * constructor
     *
     * @param string                                   $message
     * @param \Illuminate\Contracts\Support\MessageBag $errors
     * @param int                                      $code
     * @param \Exception                               $previous
     */
    public function __construct($message, MessageBag $errors, $code = 0, Exception $previous = null)
    {
        //parent
        parent::__construct($message, $code, $previous);

        //errors
        $this->errors = $errors;
    }

    /**
     * get title
     *
     * @return string
     */
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * get body
     *
     * @return string
     */
    public function getBody()
    {
        return $this->body;
    }

    /**
     * get errors
     *
     * @return \Illuminate\Contracts\Support\MessageBag
     */
    public function getErrors()
    {
        return $this->errors;
    }

}
