<?php 
class db{

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

    public function getCompanies($arraySet,$search,$order,$type,$startrange,$endrange){

        if($arraySet == 0){
            $sql = "SELECT * FROM tbl_company";
        }else{

            $orderBy;
            if ($order == 'A-Z' or $order == ""){
                $orderBy = 'ASC';
            }else if($order == 'Z-A'){
                $orderBy = 'DESC';
            }
            
            if($startrange == ''){
                $startrange = '2018-01-01 00:00:00';
            }

            if($endrange == ''){
                $endrange = '2022-01-01 00:00:00';
            }

            


            $sql = "SELECT * FROM tbl_company
            where(company_name like '%$search%')
            AND (company_type like '%$type%')
            AND (company_last_update BETWEEN '$startrange' and '$endrange')
            ORDER BY company_name $orderBy";

            var_dump($sql);


        }


        $result =  mysqli_query($this->connection,$sql);

        $companies = [];


        while($row = mysqli_fetch_row($result)){

            $id = strval($row[0]);
            $name = strval($row[1]);
            $type = strval($row[2]);
            $tel = strval($row[3]);
            $date_added = strval($row[4]);
            $date_updated = strval($row[5]);
            $description = strval($row[6]);
            $email = strval($row[7]);
            $address = strval($row[8]);

            $comapanyArr = array(
                "id" => $id,
                "name" => $name,
                "type" => $type,
                "tel" => $tel,
                "date_added" => $date_added,
                "date_updated" => $date_updated,
                "description" => $description,
                "email" => $email,
                "address" => $address
            );

            array_push($companies,$comapanyArr);

        }

        return $companies;

    }

    public function deleteCompany($companyID){

        $sql = "DELETE FROM tbl_company WHERE company_id = $companyID";
        mysqli_query($this->connection,$sql);
        return 1;
    }

    public function insertCompany($name,$type,$tel,$date,$description,$email,$address){
        $sql = "INSERT into tbl_company (company_name,company_type,company_tel,company_date_added,company_last_update,company_description,company_email,company_address)
        VALUES($name,$type,$tel,$date,$date,$description,$email,$address)";

        mysqli_query($this->connection,$sql);
    }

    public function updateCompany ($id,$name,$type,$tel,$date,$description,$email,$address) {
        $sql = "UPDATE tbl_company SET company_name = $name, company_tel = $tel ,company_description = $description,company_email = $email,
        company_address = $address,  company_type = $type 
        where company_id = $id";
        mysqli_query($this->connection,$sql);
        return $sql;

        return 1;

    }
    
    
    

}


?>
