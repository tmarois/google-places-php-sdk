<?php  namespace GooglePlaces;

class Client
{

    /**
    * $key
    *
    * Google API Key
    */
    protected $key;


    /**
    * $apiAllowedFormat
    *
    * The Google API Allowed formats
    */
    protected $apiAllowedFormat = ['json','xml'];


    /**
    * contructor
    *
    * Set the API key and return the self
    */
    public function __construct($key)
    {
        $this->key = $key;
    }


    /**
    * placeSearch
    *
    * @see \GooglePlaces\PlaceSearch
    */
    public function placeSearch($request)
    {
        return new PlaceSearch($this, $request);
    }


    /**
    * placeDetails
    *
    * @see \GooglePlaces\placeDetails
    */
    public function placeDetails()
    {
        return new PlaceDetails($this);
    }


    /**
    * placePhotos
    *
    * @see \GooglePlaces\placePhotos
    */
    public function placePhotos()
    {
        return new PlacePhotos($this);
    }


    /**
    * getKey
    *
    */
    public function getKey()
    {
        return $this->key;
    }

}
