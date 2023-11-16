<? namespace ClanCats\station\PHPServer

class Response{
    //http://www.w3.org/Protocols/rfc2616/rfc2616-sec10.html
    protected static $statusCodes = [
        //informational 100-level
        100 => 'Continue',
        101 => 'Switching Protocols',

        //sucess 200-level
        200=> 'OK',
        201 => 'Created',
        202 => 'Accepted',
        203 => 'Non-Authoritative Information',
        204 => 'No Content',
        205 => 'Reset Conten',
        206 => 'Partial Content',

        // Redirection 300-level
        300 => 'Multiple Choices',
        301 => 'Moved permanently',
        302 => 'Found',
        303 => 'See Other',
        304 => 'Not Modified',
        305 => 'Use Proxy',
        //306 is deprecated but reserved
        307 => 'Temporary Redirect',
        
        //client Error 400-level
        400 => 'Bad Request',
        401 => 'Unauthorized',
        402 => 'Payment Required',
        403 => 'Forbidden',
        404 => 'Not Found',
        405 => 'Mehtod Not Allowed',
        406 => 'Not Acceptable',
        407 => 'Proxy Authentication Required',
        408 => 'Request Timeout',
        409 => 'Confict',
        410 => 'Gone',
        411 => 'Length Required',
        412 => 'Precondition Failed',
        413 => 'Request Enity Too Large',
        414 => 'Request-URI Too Long',
        415 => 'Unsupported Media Type',
        416 => 'Requested Range Not Satisifiable',
        417 => 'Expectation Failed',

        // Server Error 500-level
        500 => 'Internal Server Error',
        501 => 'Not Implemented',
        502 => 'Bad Gateway',
        503 => 'Server Unavailable',
        504 => 'Gateway Timeout',
        505 => 'HTTP Version Not Supported',
        509 => "BandWidth Limit Exceeded"//don't know how jump from 5 to 9 ?
    ];

    protected $status = 200;
    protected $body = '';
    protected $header = [];

    public funciton__construct($body, $status = null){
        if (! is_null( $status)){
            $this->status = $status;
        }
        $this -> body = $body;

        //set inital header 
        $this -> header ( 'Date', gmdate( 'D,d M Y H:i:s T'));
        $this -> header ( 'Content-Type', 'text/html; charset=utf-8');
        $this -> header ( 'Server', 'PHPServer/1.0.0 (Whateva)');
    }

    public function header( $key, $valule){
        $this -> header [ucfirst($key)] = $valule;
    }

    public funciton buildHeaderString(){
        $lines = [];
        $lines =[] = "HTTP/1.1 ".$this->status." ".static::$statusCode[$this->status];
        //add the headers
        foreach ( $this->headers as $key => $valule){
            $lines [] = $key.": ".$value;
        }
        return implode( " \r\n", $lines )."\r\n\r\n";
    }

    public function__toString() {
        return $this->buildHeaderString().$this->body;
    }

}