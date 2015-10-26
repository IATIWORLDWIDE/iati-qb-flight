<?php

use Library\Flight\SearchRequest;
use Library\Flight\PriceRequest;
use Library\Flight\FlightFareReference;
use Library\Flight\FlightPassenger;
use Library\Flight\ContactInfo;
use Library\Flight\Foid;
use Library\Flight\Passenger;
use Library\Flight\Passport;
use Library\Flight\TicketRequest;

Class flightController Extends baseController {

public $restricted = true; //Application related. Do not pay attention!

private $isTestTicket = true; //NOTE: needs to be true for the development phase. If false then makeTicket service produces real tickets.

public function index() 
{
	$this->template->show('flight/index');
}

public function search() 
{
		
		$request = new SearchRequest();

		$request->fromAirport = $_POST['fromAirport'];
		$request->toAirport = $_POST['toAirport'];
		
		$request->allinFromCity = isset($_POST['allinFromCity']) ? true : false;
		$request->allinToCity = isset($_POST['allinToCity']) ? true : false;
		
		$request->fromDate = $_POST['fromDate'];
		
		$isRoundTrip = false;
		if($_POST['returnDate'] != null || !empty($_POST['returnDate'])){
			$request->returnDate = $_POST['returnDate'];
			$isRoundTrip = true;
		}
		
		$request->adult = @$_POST['adult'] > 0 ? $_POST['adult'] : 0;
		$request->child = @$_POST['child'] > 0 ? $_POST['child'] : 0;
		$request->infant = @$_POST['infant'] > 0 ? $_POST['infant'] : 0;
		$request->senior = @$_POST['senior'] > 0 ? $_POST['senior'] : 0;
		$request->student = @$_POST['student'] > 0 ? $_POST['student'] : 0;
		$request->young = @$_POST['young'] > 0 ? $_POST['young'] : 0;
		$request->military = @$_POST['military'] > 0 ? $_POST['military'] : 0;
		$request->disable = @$_POST['disable'] > 0 ? $_POST['disable'] : 0;
	
		$request->currency = @$_POST['currency'];
		$request->usePersonFares = isset($_POST['usePersonFares']) ? true : false;
		$request->cip = isset($_POST['cip']) ? true : false;
		
		if($_POST['filterProviders'] != null || !empty($_POST['filterProviders']))
			$request->filterProviders = explode(",", $_POST['filterProviders']);
		
		if($_POST['classType'] != null || !empty($_POST['classType']))
			$request->classType = $_POST['classType'];
			
		$http_response = $this->registry->httpclient->postJson($request, false);
		
		$this->template->isRoundTrip = $isRoundTrip;
		$this->template->searchRequest = $request->createRequest();
		$this->template->searchResult = $http_response;
		$this->template->flights = $http_response->result->flights;
		@$this->template->searchId = $http_response->result->searchId;
		
		@$_SESSION["searchRequest::".$http_response->result->searchId] = $request->createRequest();
		
		$this->template->show('flight/search_result');
		
}

public function priceDetail(){
		
		$searchQuery = json_decode($_SESSION["searchRequest::".$_POST['searchId']]);
		
		$isRoundTrip = false;
		if(isset($searchQuery->returnDate) && $searchQuery->returnDate != null && !empty($searchQuery->returnDate)){
			$isRoundTrip = true;
		}
		
		$request = new PriceRequest();
		
		$request->searchId = $_POST['searchId'];
		
		$departureFare = new FlightFareReference();
		$departureFare->itineraryId = $_POST['departureFlightId'];
		$departureFare->fareType = $_POST['departurePricingType'];
		
		if($isRoundTrip){
			$returnFare = new FlightFareReference();
			$returnFare->itineraryId = $_POST['returnFlightId'];
			$returnFare->fareType = $_POST['returnPricingType'];
			
			$request->fareRefereces = Array($departureFare, $returnFare);
		}else{
			$request->fareRefereces = Array($departureFare);
		}
		
		$passengerArray = Array();
		
		if($searchQuery->adult > 0){
			$pax = new FlightPassenger();
			$pax->type = "ADULT";
			$pax->count = $searchQuery->adult;
			array_push($passengerArray, $pax);
		}
		if($searchQuery->child > 0){
			$pax = new FlightPassenger();
			$pax->type = "CHILD";
			$pax->count = $searchQuery->child;
			array_push($passengerArray, $pax);
		}
		if($searchQuery->infant > 0){
			$pax = new FlightPassenger();
			$pax->type = "INFANT";
			$pax->count = $searchQuery->infant;
			array_push($passengerArray, $pax);
		}
		if($searchQuery->senior > 0){
			$pax = new FlightPassenger();
			$pax->type = "SENIOR";
			$pax->count = $searchQuery->senior;
			array_push($passengerArray, $pax);
		}
		if($searchQuery->student > 0){
			$pax = new FlightPassenger();
			$pax->type = "STUDENT";
			$pax->count = $searchQuery->student;
			array_push($passengerArray, $pax);
		}
		if($searchQuery->young > 0){
			$pax = new FlightPassenger();
			$pax->type = "YOUNG";
			$pax->count = $searchQuery->young;
			array_push($passengerArray, $pax);
		}
		if($searchQuery->military > 0){
			$pax = new FlightPassenger();
			$pax->type = "MILITARY";
			$pax->count = $searchQuery->military;
			array_push($passengerArray, $pax);
		}
		if($searchQuery->disable > 0){
			$pax = new FlightPassenger();
			$pax->type = "DISABLED";
			$pax->count = $searchQuery->disable;
			array_push($passengerArray, $pax);
		}
		
		$request->passengers = $passengerArray;
		
		$request->cip = $searchQuery->cip;
		$request->currency = $searchQuery->currency;
		
		$http_response = $this->registry->httpclient->postJson($request, false);
		
		$this->template->priceDetailRequest = $request->createRequest();
		$this->template->priceDetailId = $http_response->result->id;
		$this->template->priceDetail = $http_response->result;
		
		$token = md5(uniqid(mt_rand(), true));
		$this->template->token = $token;
				
		$_SESSION[$token] = Array($request, $http_response->result->id, $http_response->result);
		
		$this->template->show('flight/price_detail');
		
} 

public function makeTicket(){
	
	$priceDetailRequest = json_decode(trim($_POST['price_detail_request']));
	$priceDetailResponse = json_decode(trim($_POST['price_detail_response']));
	
	$priceDetailId = $_POST['price_detail_id'];
	
	
	$contactInfo = new ContactInfo();
	
	$contactInfo->email = $_POST["contact_email"];
	$contactInfo->mobilePhoneNumber = $_POST["contact_gsm"];
	$contactInfo->phoneNumber = $_POST["contact_phone"];
	
	$request = new TicketRequest();
	
	$request->priceDetailId = $priceDetailId;
	$request->contactInfo = $contactInfo;
	$passengerArray = Array();
	
	$z = 0;
	foreach($priceDetailResponse->fares as $fare){
		for($i = 0; $i < $fare->passengerCount; $i++){
			$pax = new Passenger();
			$pax->name = $_POST['name'][$z];
			$pax->surname = $_POST['surname'][$z];
			$pax->birthdate = $_POST['birthdate'][$z];
			$pax->gender = $_POST['gender'][$z];
			$pax->type = $fare->passangerType;
			
			$identityType = $priceDetailResponse->identityType;
			
			switch ($identityType) {
			case "TC_NO":
			    $pax->identityNo = $_POST['tc_no'][$z];
			    break;
			case "FOID":
			    $foid = new Foid();
				$pax->foid = $foid;
				
				$foid->no = $_POST['foid_no'][$z];
				$foid->citizenhipCountry = $_POST['foid_citizenhip_country'][$z];
				
			    break;
			case "PASSPORT":
			    
				$passport = new Passport();
				$pax->passport = $passport;
				
				$passport->no = $_POST['passport_no'][$z];
				$passport->serial = $_POST['passport_serial'][$z];
				$passport->issueDate = $_POST['passport_issue_date'][$z];
				$passport->endDate = $_POST['passport_end_date'][$z];
				$passport->citizenhipCountry = $_POST['passport_citizenhip_country'][$z];
				$passport->issueCountry = $_POST['passport_issue_country'][$z];
				
			    break;
			}
			
			array_push($passengerArray, $pax);
						
			$z++;
		}
	}
	
	$request->passengers = $passengerArray;
	
	$request->notes = $_POST['ticket_notes'];
	
	$request->test = $this->isTestTicket; //NOTE: needs to be true for the development phase. If false then makeTicket service produces real tickets.
	
	$request->agencyExtra = $_POST['agency_extra'];
	$request->cip = $priceDetailResponse->cip;

	$http_response = $this->registry->httpclient->postJson($request, true);
	
	$this->template->makeTicketRequest = $request;
	
	$this->template->makeTicketResponse = $http_response->result;
	
	$this->template->show('flight/make_ticket');
}	

}
?>
