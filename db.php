<?php class db{

public $connection;

    function __construct(){
        $servername = "db.bucomputing.uk";
        $username = "s5112101";
        $password = "firewire";
        $dbname = "s5112101";
        $port = "6612";

        $conn = new mysqli();
        $conn->init();
        if(!$conn){
            echo "Connection failed";
        }else{
            $conn->ssl_set(NULL,NULL,NULL,'/public_html/sys_tests', NULL);

            $conn->real_connect($servername, $username, $password, $dbname, $port, NULL, MYSQLI_CLIENT_SSL_DONT_VERIFY_SERVER_CERT);

            if($conn->connection_errorno){
                echo "Connection failed";
            }else{
                //echo"<p>Connected to server: " . $conn->host_info . "</p>";
                $this->connection = $conn;
                //echo "Set connection object";
            }
        }



    }

    public function getUsers(){
        //echo "getting users";
        $sql = "SELECT * FROM tbl_user";
        $result = mysqli_query($this->connection,$sql);

        while($row = mysqli_fetch_row($result)){
            printf("%s",$row[0]);

        }
    }

     public function loginUser($username,$password){
        $sql = "SELECT * FROM tbl_user WHERE (user_username = '$username') ";

        $result = mysqli_query($this->connection,$sql);
        //var_dump($result);



        $userRow = mysqli_fetch_assoc($result);
        $salt = $userRow['user_salt'];

        $fullPass = $password . $salt;
        $hashedPass = hash('sha256',$fullPass);


        if ($hashedPass == $userRow['user_password']){
            return true;
        }else{
            return false;
        }



    }

    public function getCompanies(){
        $sql = "SELECT * FROM tbl_company";
        $result =  mysqli_query($this->connection,$sql);

        $companies = [];


        while($row = mysqli_fetch_row($result)){

            $id = strval( $row[0]);
            $name = strval($row[1]);
            $tel = strval($row[2]);
            $date_added = strval($row[3]);
            $date_updated = strval($row[4]);
            $description = strval($row[5]);
            $email = strval($row[6]);



            
        

            $comapanyArr = array(
                "id" => $id,
                "name" => $name,
                "tel" => $tel,
                "date_added" => $date_added,
                "date_updated" => $date_updated,
                "description" => $description,
                "email" => $email
            );

            array_push($companies,$comapanyArr);

        }

        return $companies;

    }





}










?>
