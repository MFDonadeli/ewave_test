<?php

class RedisScope
{
    private $redis;
    private $source;
    private $redis_key;
    private $connected;

    public function __construct(){
        $this->connected = false;

        $this->source = "web";
    }

    /**
     * Connects to Redis server
     */
    public function connect($server, $port, $pwd){
        $this->redis = new Redis();
        
        $this->redis->connect($server,$port);

        !empty($pwd) && $this->redis->auth($pwd);

        $this->connected = true;
    }

    /**
     * Get a cache from Redis DB after check whether is connected or not
     */
    public function get($json_request)
    {
        if(!$this->connected){
            return false;
        }

        //Convert json of URL + param + data + method into sha1 to use as a key
        $this->redis_key = sha1($json_request);

        $return_request = $this->redis->get($this->redis_key);

        if($return_request){
            $this->source = "cache";
            $return_request = json_decode($return_request);
        }

        echo "Got From $this->source";

        return $return_request;
    }

    /**
     * Set cache on Redis DB
     */
    public function set($response)
    {
        if(!$this->connected){
            return false;
        }

        if($this->source == "web" && $this->redis_key){
            $this->redis->set($this->redis_key, json_encode($response));
        }
    }

}