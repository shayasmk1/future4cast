<?php 
class database {
    // The database connection
    protected static $connection;

    /**
     * Connect to the database
     * 
     * @return bool false on failure / mysqli MySQLi object instance on success
     */
    public function connect() {    
        // Try and connect to the database
        if(!isset(self::$connection)) {
            // Load configuration as an array. Use the actual location of your configuration file
            $config = parse_ini_file('config.ini'); 
            self::$connection = new mysqli(DB_HOST,DB_USER,DB_PASS,DB_NAME);
        }

        // If connection was not successful, handle the error
        if(self::$connection === false) {
            // Handle error - notify administrator, log to a file, show an error screen, etc.
            return false;
        }
        return self::$connection;
    }
    
    private function connectPDO() {    
        // Try and connect to the database
        try {
            
           $config = parse_ini_file('config.ini'); 
           $dbname = $config['dbname'];
            # MySQL with PDO_MYSQL
            return $dbh = new PDO("mysql:host=".DB_HOST.";dbname=".DB_NAME, DB_USER, DB_PASS);

          }
          catch(PDOException $e) {
              echo $e->getMessage();
          }
    }

    /**
     * Query the database
     *
     * @param $query The query string
     * @return mixed The result of the mysqli::query() function
     */
    public function query($query) {
        // Connect to the database
        $connection = $this -> connect();

        // Query the database
        $result = $connection -> query($query);

        return $result;
    }
    
    private function queryPDOFetchRow($query, $data) {
        // Connect to the database
        $dbh = $this -> connectPDO();
        
        $sth = $dbh->prepare($query);
        $sth->execute($data);
        $result = $sth->fetch();
        
        // Query the database
        //$result = $connection -> queryPDO($query);

        return $result;
    }
    
    private function queryPDOFetchAll($query, $data) {
        // Connect to the database
       
        $dbh = $this -> connectPDO();

        $sth = $dbh->prepare($query);
        
        $sth->execute($data);
        
        $result = $sth->fetchAll(PDO::FETCH_ASSOC);
        // Query the database
        //$result = $connection -> queryPDO($query);

        return $result;
    }

    private function queryInsertPDO($sql, $data)
    {
        $dbh = $this -> connectPDO();
        $values = array();
        $sth = $dbh->prepare($sql);
        foreach($data as $key => $value){
            $values[':'.$key] = $value;
        }
        $res = $sth->execute($values);
        
        if($res)
        {
            return $lastInsertID = $dbh->lastInsertId();
        }
        else
        {
            return 0;
        }
    }

    public function queryUpdatePDO($sql, $data, $conditions = null)
    {
        $dbh = $this -> connectPDO();
        $values = array();
        $sth = $dbh->prepare($sql);
        if(isset($data) && count($data) > 0)
        {
            foreach($data as $key => $value){
                $values[':'.$key] = $value;
            }
        }
        if(isset($conditions) && count($conditions) > 0)
        {
            foreach($conditions as $key => $value){
                $values[':'.$key] = $value;
            }
        }

        try {
            $res = $sth->execute($values);
        }
        catch(PDOException $e) {
            echo 'ERROR: ' . $e->getMessage();
        }
        $res = $sth->execute($values);
        if($res)
        {
            return 1;
        }
        else
        {
            return 0;
        }
    }
    
    public function queryDeletePDO($sql, $data)
    {
        $dbh = $this -> connectPDO();
        $values = array();
        $sth = $dbh->prepare($sql);
        if(isset($data) && count($data) > 0)
        {
            foreach($data as $key => $value){
                $values[':'.$key] = $value;
            }
        }
       

        try {
            $res = $sth->execute($values);
        }
        catch(PDOException $e) {
            echo 'ERROR: ' . $e->getMessage();
        }
        $res = $sth->execute($values);
        if($res)
        {
            return 1;
        }
        else
        {
            return 0;
        }
    }

    /**
     * Fetch rows from the database (SELECT query)
     *
     * @param $query The query string
     * @return bool False on failure / array Database rows on success
     */
    public function select($query) {
        $rows = array();
        $result = $this -> query($query);
        if($result === false) {
            return false;
        }
        while ($row = $result -> fetch_assoc()) {
            $rows[] = $row;
        }
        return $rows;
    }

    /**
     * Fetch the last error from the database
     * 
     * @return string Database error message
     */
    public function error() {
        $connection = $this -> connect();
        return $connection -> error;
    }

    /**
     * Quote and escape value for use in a database query
     *
     * @param string $value The value to be quoted and escaped
     * @return string The quoted and escaped string
     */
    public function quote($value) {
        $connection = $this -> connect();
        return "'" . $connection -> real_escape_string($value) . "'";
    }
    
    protected function insert($table_name,$data)
    {
        // retrieve the keys of the array (column titles)

        $fields = array_keys($data);
        
       // $columnString = implode(',', array_flip($data));
        $valueString = ":".implode(',:', ($data));
        $valueString = '';
        $dataCount = count($data);
        $count = 0;
        foreach($data AS $key => $value)
        {
            if($count > 0 && $count != $dataCount)
            {
                $valueString.= ',';
            }
            $valueString.= ':'.$key;
            $count++;
        }
        
        // build the query
          $sql = "INSERT INTO ".$table_name."(`".implode('`,`', $fields)."`) VALUES(".$valueString.")";
        
        // run and return the query result resource
        return $this->queryInsertPDO($sql, $data);
    }
    
    public function update($table_name,$data, $conditions)
    {
        // retrieve the keys of the array (column titles)

        $fields = array_keys($data);

       // $columnString = implode(',', array_flip($data));

        $valueString = '';
        $dataCount = count($data);
        $count = 0;
        foreach($data AS $key => $value)
        {
            if($count > 0 && $count != $dataCount)
            {
                $valueString.= ',';
            }
            $valueString.= $key.'=:'.$key;
            $count++;
        }

        $conditionString = '';
        $dataCount = count($data);
        $count = 0;
        foreach($conditions AS $key => $value)
        {
            if($count > 0 && $count != $dataCount)
            {
                $conditionString.= ',';
            }
            $conditionString.= $key.'=:'.$key;
            $count++;
        }


        // build the query
         $sql = "UPDATE ".$table_name." SET ".$valueString." WHERE ".$conditionString;

        // run and return the query result resource
         $res = $this->queryUpdatePDO($sql, $data, $conditions);
         
         return $res;
    }
    
    public function delete($table_name, $data)
    {
        // retrieve the keys of the array (column titles)

        $fields = array_keys($data);

       // $columnString = implode(',', array_flip($data));

        $valueString = '';
        $dataCount = count($data);
        $count = 0;
        foreach($data AS $key => $value)
        {
            if($count > 0 && $count != $dataCount)
            {
                $valueString.= ' AND ';
            }
            $valueString.= $key.'=:'.$key;
            $count++;
        }

        $conditionString = '';
        $dataCount = count($data);
        $count = 0;
        

        // build the query
          $sql = "DELETE FROM ".$table_name." WHERE ".$valueString;

        // run and return the query result resource
         $res = $this->queryDeletePDO($sql, $data);
         
         return $res;
    }

    public function fetchRow($table_name,$where = null, $orderValue = null, $orderBy = null, $limit = null,$noOfRecords = null)
    {
        $html = '';
        $count = 0;
        $values = array();
        if($where != null)
        {
            foreach($where AS $key => $value)
            {
                $values[] = $value;
                if($count > 0)
                {
                    $html.=" AND ";
                }
                $html.= $key.'=?';
                $count++;
            }
        }
        $htmlWhere = '';
        if($where != null)
        {
            $htmlWhere.= " WHERE ".$html;
        }
        $orderHtml = '';
        if($orderValue != null)
        {
            $orderHtml.= " ORDER BY ? ".$orderValue;
            $values[] = $orderValue;
            if($orderBy != null)
            {
               $orderHtml.= " ".$orderBy; 
               $values[] = $orderBy;
            }
        }
        
        $limitHtml = '';
        if($limit != null && $noOfRecords != null)
        {
            $limitHtml.= " LIMIT ?,? ";
            $values[] = $limit;
            $values[] = $noOfRecords;
        }
        $sql = "SELECT * FROM ".$table_name." ".$htmlWhere." ".$orderHtml." ".$limitHtml;
        return $this->queryPDOFetchRow($sql, $values);
        
    }

    protected function fetchAll($table_name,$data = null, $orderValue = null, $orderBy = null, $limit = null,$noOfRecords = null)
    {
        $html = '';
        $count = 0;
        $values = array();
        if($data != null)
        {
            foreach($data AS $key => $value)
            {
                $values[] = $value;
                if($count > 0)
                {
                    $html.=" AND ";
                }
                $html.= $key.'=?';
                $count++;
            }
        }
        $htmlWhere = '';
        
        if($data != null)
        {
            $htmlWhere = " WHERE ".$html;
        }
        
        $orderHtml = '';
        if($orderValue != null)
        {
            $orderHtml.= " ORDER BY '".$orderValue."' ";
            
            if($orderBy != null)
            {
               $orderHtml.= " ".$orderBy; 
            }
        }
        
        $limitHtml = '';
        if($noOfRecords != null)
        {
            if($limit == null)
            {
                $limit = 0;
            }
            $limitHtml.= " LIMIT ".$limit.",".$noOfRecords." ";
            
        }
        $sql = "SELECT * FROM ".$table_name." ".$htmlWhere." ".$orderHtml." ".$limitHtml;


       return $this->queryPDOFetchAll($sql, $values);
      
        
    }
    
    public function callQuery($query, $values = null)
    {
       return $this->queryPDOFetchAll($query, $values); 
    }
}
