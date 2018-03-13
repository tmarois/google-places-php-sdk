<?php  namespace GooglePlaces;

use \GuzzleHttp\Client as HttpRequest;

class Request
{

    /**
    * $client
    *
    * @see \GooglePlaces\PlaceDetails|\GooglePlaces\Photos|\GooglePlaces\Search
    */
    protected $builder;


    /**
    * $httpResponse
    *
    * @see \GuzzleHttp\Client
    */
    protected $httpResponse;


    /**
    * $output
    *
    */
    protected $output;


    /**
    * $statusErrors
    *
    */
    protected $statusErrors = [
        'OVER_QUERY_LIMIT', 'REQUEST_DENIED', 'INVALID_REQUEST', 'UNKNOWN_ERROR', 'ZERO_RESULTS'
    ];


    /**
    * contructor
    *
    */
    public function __construct($builder)
    {
        $this->builder = $builder;

        $this->setHttpResponse();

        if ($this->httpResponse->getStatusCode() !== 200)
        {
            throw new \Exception('Http Status Code: '.$this->httpResponse->getStatusCode());
        }
        else
        {
            $this->output = json_decode($this->httpResponse->getBody(),1);

            $this->throwAnError();
        }
    }


    /**
    * setHttpResponse
    *
    */
    protected function setHttpResponse()
    {
        $options = $this->builder->getOptions();

        $queryOptions = [
            'key' => $this->builder->client()->getKey()
        ];

        $this->httpResponse = (new HttpRequest())->request('GET', $this->builder->getPath(), ['query' => array_merge($queryOptions, $options)]);
    }


    /**
    * throwAnError
    *
    */
    protected function throwAnError()
    {
        if (is_array($this->output))
        {
            if (isset($this->output['status']) && isset($this->output['error_message']))
            {
                throw new \Exception($this->output['status'].': '.$this->output['error_message']);
            }

            if (isset($this->output['status']) && in_array($this->output['status'], $this->statusErrors))
            {
                throw new \Exception($this->output['status']);
            }

            return true;
        }

        throw new \Exception('Output format is not correct.');
    }


    /**
    * output
    *
    */
    public function output($format = 'json')
    {
        return $this->builder->response($this->output);
    }

}
