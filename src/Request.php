<? php namespace CLanCats\station\PHPServer

class Request{

    protected $method = null;
    protected $uri = null;
    protected $parameters = [];
    protected $headers = [];

    //parse header
    public static function withHeaderString( $header){
        //explode the string into lines.
        $lines = explode ( "\n", $header);

        //extract the method and uri
        list ($method, $uri) = explode( ' ', array_shift( $lines));
        $headers = [];

        foreach($lines as $line){
            //clean the line 
            $line = trim($line);
            if (strpos ( $line, ': ') !== false){
                list($key, $value) = explode(': ', $line);
                $header[$key] = $value;
            }
        }
        return new static ($method, $uir, $headers);
    }

    //Getter method 
    public funciton mehod(){
        return $this->method;
    }

    public function uri(){
        return $this->uri;
    }
}