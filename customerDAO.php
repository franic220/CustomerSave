<?php
require_once('customerAbstractDAO.php');
require_once('customer.php');

class customerDAO extends customerAbstractDAO {
        
    function __construct() {
        try{
            parent::__construct();
        } catch(mysqli_sql_exception $e){throw $e;}
    }
    
    public function getCustomers(){
        $result = $this->mysqli->query('SELECT * FROM mailinglist');
        $customers = Array();
        
        if($result->num_rows > 0){
            while($row = $result->fetch_assoc()){
                $customer = new Customer( $row['customerName'], $row['phoneNumber'], $row['emailAddress'], $row['referrer']);
                $customer->setCustomerId($row['_id']);
                $customers[] = $customer;
            }
            $result->free();
            return $customers;
        }
        $result->free();
        return false;
    }
    
    public function getCustomer($_id){
        $query = 'SELECT * FROM mailinglist WHERE _id = ?';
        $stmt = $this->mysqli->prepare($query);
        $stmt->bind_param('i', $_id);
        $stmt->execute();
        $result = $stmt->get_result();
        if($result->num_rows == 1){
            $outcome = $result->fetch_assoc();
            $customer = new Customer($outcome['customerName'], $outcome['phoneNumber'], $outcome['emailAddress'], $outcome['referrer']);
            $customer->setCustomerId($outcome['_id']);
            $result->free();
            return $customer;
        }
        $result->free();
        return false;
    }

    public function addCustomer($customer){

        if(!$this->getMysqli()->connect_errno){
            $query = 'INSERT INTO mailinglist (customerName, phoneNumber, emailAddress, referrer) VALUES (?,?,?,?)';
            $stmt = $this->mysqli->prepare($query);
            $emailEncrypt = password_hash($customer->getEmail(), PASSWORD_DEFAULT);
            $stmt->bind_param('ssss',$customer->getCustomerName(), $customer->getNumber(), $emailEncrypt , $customer->getRefer());
            
            $stmt->execute();
            if($stmt->error){
                return $stmt->error;
            } else {
                echo $customer->getCustomerName() . ' added successfully!';
            }
        } else {
            echo 'Could not connect to Database.';
        }
    }
    
    public function deleteCustomer($_id){
        if(!$this->mysqli->connect_errno){
            $query = 'DELETE FROM mailinglist WHERE _id = ?';
            $stmt = $this->mysqli->prepare($query);
            $stmt->bind_param('i', $_id);
            $stmt->execute();
            if($stmt->error){
                return false;
            } else {
                return true;
            }
        } else {
            return false;
        }
    }
    
    public function editCustomer($_id, $customerName, $phoneNumber, $emailAddress, $referrer ){
        if(!$this->mysqli->connect_errno){
            $query = 'UPDATE mailinglist SET customerName = ?, phoneNumber = ?, emailAddress = ?, referrer = ?  WHERE _id = ?';
            $requested = $this->mysqli->prepare($query);
            $emailEncrypt = password_hash($emailAddress, PASSWORD_DEFAULT);
            $requested->bind_param('ssssi', $customerName, $phoneNumber, $emailEncrypt, $referrer, $_id);
            $requested->execute();
            if($requested->error){
                return false;
            } else {
                return $requested->affected_rows;
            }
        } else {
            return false;
        }
    }


    public function editName($_id, $customerName) {
        if(!$this->mysqli->connect_errno){
            $query = 'UPDATE mailinglist SET customerName = ? WHERE _id = ?';
            $requested = $this->mysqli->prepare($query);
            $requested->bind_param('si', $customerName, $_id);
            $requested->execute();
            if($requested->error){
                return false;
        } else {
            return $requested->affected_rows;
        }
    } else {
        return false;
    }
}

public function editPhone($_id, $phoneNumber) {
    if(!$this->mysqli->connect_errno){
        $query = 'UPDATE mailinglist SET phoneNumber = ? WHERE _id = ?';
        $requested = $this->mysqli->prepare($query);
        $requested->bind_param('si', $phoneNumber, $_id);
        $requested->execute();
        if($requested->error){
            return false;
    } else {
        return $requested->affected_rows;
    }
} else {
    return false;
}
}

public function editEmail($_id, $emailAddress) {
    if(!$this->mysqli->connect_errno){
        $query = 'UPDATE mailinglist SET emailAddress = ? WHERE _id = ?';
        $requested = $this->mysqli->prepare($query);
        $emailEncrypt = password_hash($emailAddress, PASSWORD_DEFAULT);
        $requested->bind_param('si', $emailEncrypt, $_id);
        $requested->execute();
        if($requested->error){
            return false;
    } else {
        return $requested->affected_rows;
    }
} else {
    return false;
}
}

public function editReferrer($_id, $referrer) {
    if(!$this->mysqli->connect_errno){
        $query = 'UPDATE mailinglist SET referrer = ? WHERE _id = ?';
        $requested = $this->mysqli->prepare($query);
        $requested->bind_param('si', $referrer, $_id);
        $requested->execute();
        if($requested->error){
            return false;
    } else {
        return $requested->affected_rows;
    }
} else {
    return false;
}
}

public function editNamePhone($_id, $customerName, $phoneNumber) {
    if(!$this->mysqli->connect_errno){
        $query = 'UPDATE mailinglist SET customerName = ?, phoneNumber = ? WHERE _id = ?';
        $requested = $this->mysqli->prepare($query);
        $requested->bind_param('ssi', $customerName, $phoneNumber, $_id);
        $requested->execute();
        if($requested->error){
            return false;
    } else {
        return $requested->affected_rows;
    }
} else {
    return false;
}
}

public function editNameEmail($_id, $customerName, $emailAddress) {
    if(!$this->mysqli->connect_errno){
        $query = 'UPDATE mailinglist SET customerName = ?, emailAddress = ? WHERE _id = ?';
        $requested = $this->mysqli->prepare($query);
        $emailEncrypt = password_hash($emailAddress, PASSWORD_DEFAULT);
        $requested->bind_param('ssi', $customerName, $emailEncrypt, $_id);
        $requested->execute();
        if($requested->error){
            return false;
    } else {
        return $requested->affected_rows;
    }
} else {
    return false;
}
}

public function editNameReferrer($_id, $customerName, $referrer) {
    if(!$this->mysqli->connect_errno){
        $query = 'UPDATE mailinglist SET customerName = ?, referrer = ? WHERE _id = ?';
        $requested = $this->mysqli->prepare($query);
        $requested->bind_param('ssi', $customerName, $referrer, $_id);
        $requested->execute();
        if($requested->error){
            return false;
    } else {
        return $requested->affected_rows;
    }
} else {
    return false;
}
}

public function editPhoneEmail($_id, $phoneNumber, $emailAddress) {
    if(!$this->mysqli->connect_errno){
        $query = 'UPDATE mailinglist SET phoneNumber = ?, emailAddress = ? WHERE _id = ?';
        $requested = $this->mysqli->prepare($query);
        $emailEncrypt = password_hash($emailAddress, PASSWORD_DEFAULT);
        $requested->bind_param('ssi', $phoneNumber, $emailEncrypt, $_id);
        $requested->execute();
        if($requested->error){
            return false;
    } else {
        return $requested->affected_rows;
    }
} else {
    return false;
}
}

public function editPhoneReferrer($_id, $phoneNumber, $referrer) {
    if(!$this->mysqli->connect_errno){
        $query = 'UPDATE mailinglist SET phoneNumber = ?, referrer = ? WHERE _id = ?';
        $requested = $this->mysqli->prepare($query);
        $requested->bind_param('ssi', $phoneNumber, $referrer, $_id);
        $requested->execute();
        if($requested->error){
            return false;
    } else {
        return $requested->affected_rows;
    }
} else {
    return false;
}
}

public function editEmailReferrer($_id, $emailAddress, $referrer) {
    if(!$this->mysqli->connect_errno){
        $query = 'UPDATE mailinglist SET emailAddress = ?, referrer = ? WHERE _id = ?';
        $requested = $this->mysqli->prepare($query);
        $emailEncrypt = password_hash($emailAddress, PASSWORD_DEFAULT);
        $requested->bind_param('ssi', $emailEncrypt, $referrer, $_id);
        $requested->execute();
        if($requested->error){
            return false;
    } else {
        return $requested->affected_rows;
    }
} else {
    return false;
}
}


public function editNamePhoneEmail($_id, $customerName, $phoneNumber, $emailAddress) {
    if(!$this->mysqli->connect_errno){
        $query = 'UPDATE mailinglist SET customerName = ?, phoneNumber = ?, emailAddress = ? WHERE _id = ?';
        $requested = $this->mysqli->prepare($query);
        $emailEncrypt = password_hash($emailAddress, PASSWORD_DEFAULT);
        $requested->bind_param('sssi', $customerName, $phoneNumber, $emailEncrypt, $_id);
        $requested->execute();
        if($requested->error){
            return false;
    } else {
        return $requested->affected_rows;
    }
} else {
    return false;
}
}

public function editNamePhoneReferrer($_id, $customerName, $phoneNumber, $referrer) {
    if(!$this->mysqli->connect_errno){
        $query = 'UPDATE mailinglist SET customerName = ?, phoneNumber = ?, referrer = ? WHERE _id = ?';
        $requested = $this->mysqli->prepare($query);
        $requested->bind_param('sssi', $customerName, $phoneNumber, $referrer, $_id);
        $requested->execute();
        if($requested->error){
            return false;
    } else {
        return $requested->affected_rows;
    }
} else {
    return false;
}
}

public function editNameEmailReferrer($_id, $customerName, $emailAddress, $referrer) {
    if(!$this->mysqli->connect_errno){
        $query = 'UPDATE mailinglist SET customerName = ?, emailAddress = ?, referrer = ? WHERE _id = ?';
        $requested = $this->mysqli->prepare($query);
        $emailEncrypt = password_hash($emailAddress, PASSWORD_DEFAULT);
        $requested->bind_param('sssi', $customerName, $emailEncrypt, $referrer, $_id);
        $requested->execute();
        if($requested->error){
            return false;
    } else {
        return $requested->affected_rows;
    }
} else {
    return false;
}
}

public function editPhoneEmailReferrer($_id, $phoneNumber, $emailAddress, $referrer) {
    if(!$this->mysqli->connect_errno){
        $query = 'UPDATE mailinglist SET phoneNumber = ?, emailAddress = ?, referrer = ? WHERE _id = ?';
        $requested = $this->mysqli->prepare($query);
        $emailEncrypt = password_hash($emailAddress, PASSWORD_DEFAULT);
        $requested->bind_param('sssi', $phoneNumber, $emailEncrypt, $referrer, $_id);
        $requested->execute();
        if($requested->error){
            return false;
    } else {
        return $requested->affected_rows;
    }
} else {
    return false;
}
}

}


?>