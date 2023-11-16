<?php

namespace ClanCats\station\PHPServer;

class Server {
    protected $host = null;
    protected $port = null;
    protected $socket = null;

    // AF_INET is for IPv4; TCP; UDP
    // SOCK_STREAM is a simple full-duplex connection-based byte stream
    protected function createSocket() {
        $this->socket = socket_create(AF_INET, SOCK_STREAM, 0);
    }

    // socket_bind function returns false when something goes wrong.
    // Since this should never happen, we throw an exception with the socket error message
    protected function bind() {
        if (!socket_bind($this->socket, $this->host, $this->port)) {
            throw new Exception('Could not bind: ' . $this->host . ':' . $this->port . ' - ' . socket_strerror(socket_last_error()));
        }
    }

    public function __construct($host, $port) {
        $this->host = $host;
        $this->port = (int) $port;

        // Create a socket
        $this->createSocket();

        // Bind the socket
        $this->bind();
    }

    // Listen for connection
    public function listen($callback) {
        // Check if the callback is valid, throw an exception if not
        if (!is_callable($callback)) {
            throw new \Exception('The given argument should be callable!');
        }
    
        while (true) {
            // Listen for connections
            socket_listen($this->socket);
    
            // Try to get the client socket resource
            // If false, we got an error; close the connection and skip
            if (!$client = socket_accept($this->socket)) {
                socket_close($client);
                continue;
            }
    
            // Create new request instance with the client header
            // In the real world, X will be dynamic
            $request = Request::withHeaderString(socket_read($client, 1024));
    
            // Determine the response based on the request
            if ($request->getPath() == '/') {
                // Root URL - Send a welcome message
                $response = new Response(200, 'Welcome to my PHP Server!');
            } else {
                // Other URLs - Send a custom message
                $response = new Response(200, 'You requested: ' . $request->getPath());
            }
    
            // Make a string out of our response
            $response = (string) $response;
    
            // Write the response to the client socket
            socket_write($client, $response, strlen($response));
    
            // Close the connection
            socket_close($client);
        }
    }
    
}
