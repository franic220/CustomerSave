<?php
	class Customer{
		private $_id;private $customerName; private $phoneNumber; private $emailAddress; private $referrer;
		function __construct($customerName, $phoneNumber, $emailAddress, $referrer){
			$this->setCustomerName($customerName);
            $this->setNumber($phoneNumber);
            $this->setEmail($emailAddress);
            $this->setRefer($referrer);
		}
		
		public function getCustomerId(){return $this->_id;}
		public function setCustomerId($_id){$this->_id = $_id;}
		
		public function getCustomerName(){return $this->customerName;}
		public function setCustomerName($customerName){$this->customerName = $customerName;}
		
		public function getNumber(){return $this->phoneNumber;}
		public function setNumber($phoneNumber){$this->phoneNumber = $phoneNumber;}
        
        public function getEmail(){return $this->emailAddress;}
        public function setEmail($emailAddress){$this->emailAddress= $emailAddress;}

        public function getRefer(){return $this->referrer;}
        public function setRefer($referrer){$this->referrer= $referrer;}
		
	}
?>