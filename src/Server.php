<?php namespace ClanCats\station\PHPServer;

//Server Object


class Server {
    protected $host = null;
    protected $port = null;
    protected $socket = null;

    /*
    AF_INET is for IPv4; TCP; UPD
    SOCK_STREAM is a simple full-dexplex connection based byte stream
    */
    protected function createSocket(){
        $this->socket = socket_create( AF_INET, SOCK_STREAM, 0);
    }

    /*
    socket_bind function returns fase when something goes wrong.
    coz this should never happen we throw an expection with the socket error message
    */
    protected function bind(){
        if (!socket_bind($this->socket, $this->host, $this->port)){
            throw new Expection('Could not bind:'.$this->host.':'
            .$this->port,' - '.socket_strerror( socket_last_error()));
        }

    public funciton__construct ( $host, $port){
        $this->host = $host;
        $this->port = $port;

        //ctreate a socket
        $this -> createSocket();
        
        //bind the socket
        $this->bind();
    }

    //Listen for connection 
    public function listen( $callback){
        
        //check if the callback is valid throw an exception
        //if not:
        if (! is_callable( $callback)){
            throw new Exceptoin('The give argument should be callable!!!');
        }
        
        while(1){
                //listen for connections
                socket_listen( $this ->socket);

                //try to get the clietn socket resource
                //if false we got an error close the connection and skip
                if (!$client = socket_accept( $this->sokcet)){
                    socket_close( $client); continue;
                }

                //create new request instance with the client header
                //In teh real world X will be dynimaic 
                $x = 1024;
                $request = Request::withHeaderString( socket_read( $client, x));

                //execute teh callback
                $response = call_user_func( $callback, $request);

                //check if we really recived a response object
                // if not return a 404 
                if (!$response || !$response instanceof Response){
                    $response = Response::error(404);
                }

                //make a string out of our response
                $response = (string) $response;

                //write the response to the client socket
                socket_write( $client, $response, strlne( $response));

                //close the connection 
                socket_close( $client);
        }

    }

    }
}