<?php 

// Database wrapper class that handles queries on method calls
class db{

private $connection; //Connection attribute to be used by methods

    //Connects to the database on creation.
    function __construct(){
        //login credentials
        $servername = "db.bucomputing.uk";
        $username = "s5112101";
        $password = "firewire";
        $dbname = "s5112101";
        $port = "6612";

        $conn = new mysqli();
        $conn->init();
        //testing for connection
        if(!$conn){
            echo "Connection failed";
        }else{
            $conn->ssl_set(NULL,NULL,NULL,'/public_html/sys_tests', NULL);
            $conn->real_connect($servername, $username, $password, $dbname, $port, NULL, MYSQLI_CLIENT_SSL_DONT_VERIFY_SERVER_CERT);

            if($conn->connection_errorno){
                echo "Connection failed";
            }else{
                //Connection success
                $this->connection = $conn;
                
            }
        }



    }

    

    public function loginUser($username,$password){
        //Get the user by username
        $sql = "SELECT * FROM tbl_user WHERE (user_username = '$username') ";

        $result = mysqli_query($this->connection,$sql);

        $userRow = mysqli_fetch_assoc($result);
        // Gets the users salt from the returned row
        $salt = $userRow['user_salt'];
        //combine the entered password with the users real salt
        $fullPass = $password . $salt;
        //Hashing the entered password with the users real salt
        $hashedPass = hash('sha256',$fullPass);
        
        //Comparing hashed entry to the users real password
        if ($hashedPass == $userRow['user_password']){
            return true;
        }else{
            return false;
        }
    }
    //Returns every company in 
    public function getCompanies($arraySet,$search,$order,$type,$startrange,$endrange,$startLimit= NULL,$endLimit= NULL){
        
        //if search was not used get all companies
        if($startLimit == NULL){
            $startLimit = 0;
        }
        if($endLimit == NULL){
            $endLimit = 11;

        }

        if($arraySet == 0){
            $sql = "SELECT * FROM tbl_company limit $startLimit,$endLimit";
        }else{
            //Getting which order the user has selected and formatting it for the query
            $orderBy;
            if ($order == 'A-Z' or $order == ""){
                $orderBy = 'ASC';
            }else if($order == 'Z-A'){
                $orderBy = 'DESC';
            }
            // Setting a min and max date in the case of no search option selected
            if($startrange == ''){
                $startrange = '2018-01-01 00:00:00';
            }
            
            if($endrange == ''){
                $endrange = '2022-01-01 00:00:00';
            }
            

            

            //Search query with parameters
            $sql = "SELECT * FROM tbl_company
            where(company_name like '%$search%')
            AND (company_type like '%$type%')
            AND (company_last_update BETWEEN '$startrange' and '$endrange')
            ORDER BY company_name $orderBy  limit $startLimit, $endLimit";


        }

        
        $result =  mysqli_query($this->connection,$sql);

        $companies = [];

        //Creating array object
        while($row = mysqli_fetch_row($result)){
            
            //Get fields
            $id = strval($row[0]);
            $name = strval($row[1]);
            $type = strval($row[2]);
            $tel = strval($row[3]);
            $date_added = strval($row[4]);
            $date_updated = strval($row[5]);
            $description = strval($row[6]);
            $email = strval($row[7]);
            $address = strval($row[8]);
            //Put felids into array object
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
            //Pushing array object to companies variable
            array_push($companies,$comapanyArr);

        }

        return $companies;

    }
    // Deletes company by ID
    public function deleteCompany($companyID){

        $sql = "DELETE FROM tbl_company WHERE company_id = $companyID";
        mysqli_query($this->connection,$sql);
        return 1;
    }
    //Inserts a company with given information
    public function insertCompany($name,$type,$tel,$date,$description,$email,$address){
        $sql = "INSERT into tbl_company (company_name,company_type,company_tel,company_date_added,company_last_update,company_description,company_email,company_address)
        VALUES($name,$type,$tel,$date,$date,$description,$email,$address)";

        mysqli_query($this->connection,$sql);
        return 1;

    }
    // Updates an existing company with given information
    public function updateCompany ($id,$name,$type,$tel,$date,$description,$email,$address) {
        $sql = "UPDATE tbl_company SET company_name = $name, company_tel = $tel ,company_description = $description,company_email = $email,
        company_address = $address,  company_type = $type 
        where company_id = $id";
        mysqli_query($this->connection,$sql);
        return $sql;

        return 1;

    }
    public function getCompanyCount(){
        $sql = "SELECT count(company_id) from tbl_company";
        $result =  mysqli_query($this->connection,$sql);

        $count = mysqli_fetch_row($result)[0];
        return $count;


        
    }
    
}


?>
