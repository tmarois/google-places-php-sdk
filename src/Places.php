<?php  namespace GooglePlaces;

class Places
{

    /**
    * $client
    *
    * @see \GooglePlaces\Client
    */
    protected $client;


    /**
    * $apiPath
    *
    * The Google API URL
    */
    protected $apiPath = '';


    /**
    * $apiOptions
    *
    * The Google API Paramters to pass
    */
    protected $apiOptions = [];


    /**
    * contructor
    *
    */
    public function __construct(Client $client)
    {
        $this->client = $client;
    }


    /**
    * client
    *
    */
    public function client()
    {
        return $this->client;
    }


    /**
    * getPath
    *
    */
    public function getOptions()
    {
        return $this->apiOptions;
    }


    /**
    * getPath
    *
    */
    public function getPath()
    {
        return $this->apiPath;
    }


    /**
    * options
    *
    */
    public function setOptions(array $options = [])
    {
        $this->apiOptions = $options;

        return $this;
    }


    /**
    * response
    *
    */
    public function response(array $output = [])
    {
        return ($output) ?? [];
    }


    /**
    * request
    *
    */
    public function request()
    {
        return (new Request($this))->output('json');
    }

}
