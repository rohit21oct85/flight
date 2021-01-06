<?php

class AirplaneModel {

	public $brand;
	public $model;
	private $type;
	private $destination;
	private $flight_no;
	public $seat_no;
	private $seats = [];

	protected $first_name;
	protected $last_name;
	protected $age;
	protected $gender;
	protected $flight_name;
	protected $assign_seat;

	protected $passengers = [];
	protected $checkInUser = [];
	
	/*
		$brand = 'airplane brand'
		$model = 'airplane model'
		$destination = 'airplane destination'
		$brand = 'airplane brand'
	*/
	function createAirlines($brand, $model, $destination, $flight_no){
			$this->brand = $brand;
			$this->model = $model;
			$this->destination = $destination;
			$this->flight_no = $flight_no;
	}
	/* 
	Get Airplane Brand Name
	*/
	public function getBrand(){
		return $this->brand = $this->brand;
	}
	/*
	get Airplane Model Name
	*/
	public function getModel(){
		return $this->model = $this->model;
	}

	/*
	get the Brand Destination
	*/
	public function getDestination(){
		return $this->destination = $this->destination;
	}
	

	public function getFlightNo(){
		return $this->flight_no = $this->flight_no;
	}
	

	function assignSeat($type, $seat_no){
		return $seats = ["type" => $type, "seat_no" => $seat_no];
	}

	function bookPassengers($first_name, $last_name, $age, $gender, $flight_name, $assign_seat){
		return $this->passengers =  [
			"first_name" => $first_name,
			"last_name" => $last_name,
			"age" => $age,
			"gender" => $gender,
			"flight_name" => $flight_name,
			"assign_seat" => $assign_seat
		];
	}

	function checkInUser($brand, $user){
		return $this->checkInUser = [
			"user" => $user,
			"flight_no" => $brand['flight_no'],
			"flight_name" => $brand['flight_name'],
			"checkinTime" => date("Y-m-d H:i:s ")
		];
	}
	
}

class AirlineCompany extends AirplaneModel{
	
	public $carrierName;
	public $headQuarters;
	public $models = [];
	public $allPassengers = [];
	public $allAirlines = [];

	function __construct($carrierName, $headQuarters){
		$this->carrierName = $carrierName;
		$this->headQuarters = $headQuarters;
		$this->allAirlines[] = ["carrier" => $carrierName, "head_quarter" => $headQuarters];
	}
	function getAllAirlines(){
		return $this->allAirlines;
	}
	function createModels(){
		$boeing = new AirplaneModel("Boeing", "737-800", "Australlia", "BO-737-800");
		$airbus = new AirplaneModel("Airbus", "A380", "UAE", "A380");
		$dash = new AirplaneModel("Dash", "8", "INDIA" ,"D8");
		return $this->models = ["Boeing" => $boeing, "Airbus" => $airbus, "Dash" => $airbus];
	}
	
	function getAirModels($model){
		return $this->models[$model];
	}

	function getTotalSeatNo($seatArray){
		$total_seat = 0;
		foreach($seatArray as $key => $value){
			$total_seat += $value['seat_no'];
		}
		return $total_seat;
	}

	function getOccupiedSeats($occupiedSeatArray){
		$total_occupied = 0;
		foreach($occupiedSeatArray as $key => $value){
			$total_occupied += $value['assign_seat'];
		}
		return $total_occupied;
	}

	function getAvailableSeat($totalSeats, $occupiedSeats){
		return $totalSeats - $occupiedSeats;
	}

	function getAllPacengers(){
		return $this->allPassengers;
	}

	function getModels(){
		
		$models = $this->createModels();
		$boeing =  $models["Boeing"];
		$seat_boeing[] = $boeing->assignSeat("first_class", 10);
		$seat_boeing[] = $boeing->assignSeat("Business", 13);
		$seat_boeing[] = $boeing->assignSeat("Premium Economy", 0);
		$seat_boeing[] = $boeing->assignSeat("Economy Seats", 0);

		$total_seat_boaing = $this->getTotalSeatNo($seat_boeing);

		$boeing_passenger[] = $boeing->bookPassengers("Rohit","Singh", 35, "Male", $boeing->getFlightNo() ,1);
		$boeing_passenger[] = $boeing->bookPassengers("Sweety","Singh", 35, "Male", $boeing->getFlightNo() , 2);
		$boeing_occupied_seats = $this->getOccupiedSeats($boeing_passenger);
		$boeing_availabel = $this->getAvailableSeat($total_seat_boaing, $boeing_occupied_seats);
		$checkinTime_boeing = $this->checkInUser([
			"flight_no" => $boeing->getFlightNo(),
			"flight_name" => $boeing->getModel(),
		], $boeing_passenger[0]);


		$airbus =  $models["Airbus"];
		$seat_airbus[] = $airbus->assignSeat("first_class", 14);
		$seat_airbus[] = $airbus->assignSeat("Business", 64);
		$seat_airbus[] = $airbus->assignSeat("Premium Economy", 35);
		$seat_airbus[] = $airbus->assignSeat("Economy Seats", 371);

		$total_seat_airbus = $this->getTotalSeatNo($seat_airbus);
		
		$airbus_passenger[] = $airbus->bookPassengers("Shruti","Sharma", 35, "Male", $airbus->getFlightNo() , 2);
		$airbus_passenger[] = $airbus->bookPassengers("Misti","Sharma", 45, "Male", $airbus->getFlightNo() , 2);
		$airbus_occupied_seats = $this->getOccupiedSeats($airbus_passenger);
		
		$airbus_availabel = $this->getAvailableSeat($total_seat_airbus, $airbus_occupied_seats);

		$checkinTime_airbus = $this->checkInUser([
			"flight_no" => $airbus->getFlightNo(),
			"flight_name" => $airbus->getModel(),
		], $airbus_passenger[0]);

		$dash =  $models["Dash"];
		$seat_dash[] = $dash->assignSeat("first_class", 50);
		$seat_dash[] = $dash->assignSeat("Business", 100);
		$seat_dash[] = $dash->assignSeat("Premium Economy", 30);
		$seat_dash[] = $dash->assignSeat("Economy Seats", 38);
		
		$total_seat_dash = $this->getTotalSeatNo($seat_dash);

		$dash_passenger[] = $dash->bookPassengers("Shruti","Sharma", 35, "FeMale", $dash->getFlightNo() , 3);;
		$dash_passenger[] = $dash->bookPassengers("Sanjay","Sharma", 35, "Male", $dash->getFlightNo() , 3);;
		

		$dash_occupied_seats = $this->getOccupiedSeats($dash_passenger);
		$dash_availabel = $this->getAvailableSeat($total_seat_dash, $dash_occupied_seats);
		
		$checkinTime_dash = $this->checkInUser([
			"flight_no" => $dash->getFlightNo(),
			"flight_name" => $dash->getModel(),
		], $dash_passenger[1]);

		$combine_array = array_merge($boeing_passenger, $airbus_passenger);
		$this->allPassengers = array_merge($combine_array, $dash_passenger);
		
		return [
			"Boeing" => [
				"Brand" => $boeing->getBrand(),
				"Model" => $boeing->getModel(),
				"FlightNO" => $boeing->getFlightNo(),
				"Destination" => $boeing->getDestination(),
				"seat_class" => $seat_boeing,
				"seats" => $total_seat_boaing,
				"available" => $boeing_availabel,
				"occupied" => $boeing_occupied_seats,
				"passenger_list" => $boeing_passenger,
				"checkinTime" => $checkinTime_boeing,
			],
			"Airbus" => [
				"Brand" => $airbus->getBrand(),
				"Model" => $airbus->getModel(),
				"FlightNO" => $airbus->getFlightNo(),
				"Destination" => $airbus->getDestination(),
				"seat_class" => $seat_airbus,
				"total_seat" => $total_seat_airbus,
				"available" => $airbus_availabel,
				"occupied" => $airbus_occupied_seats,
				"passenger_list" => $airbus_passenger,
				"checkinTime" => $checkinTime_airbus,
			],
			"Dash" => [
				"Brand" => $dash->getBrand(),
				"Model" => $dash->getModel(),
				"FlightNO" => $dash->getFlightNo(),
				"Destination" => $dash->getDestination(),
				"seat_class" => $seat_dash,
				"seats" => $total_seat_dash,
				"available" => $dash_availabel,
				"occupied" => $dash_occupied_seats,
				"passenger_list" => $dash_passenger,
				"checkinTime" => $checkinTime_dash,

			],
		];
	}
	function getCarrierName(){
		return $this->carrierName = $this->carrierName;
	}

	function getHeadQuarters(){
		return $this->headQuarters = $this->headQuarters;
	}

}

$firstAirlines = new AirlineCompany("Quantis", "Australlia");
$secondAirlines = new AirlineCompany("Emirites", "UAE");

$models = $firstAirlines->getModels();


echo "<br />";
echo "<h2>All Airlines List</h2>";
echo "<pre>";
print_r($firstAirlines->getAllAirlines());
echo "</pre?";



echo "<br />";
echo "<h2>Get Brand Details ". ucFirst(@$_GET["brand"]) ." </h2>";
echo "<pre>";
print_r(@$models[ucFirst(@$_GET["brand"])]);
echo "</pre?";



echo "<br />";
echo "<h2>All Pacengers List</h2>";
echo "<pre>";
print_r($firstAirlines->getAllPacengers());
echo "</pre?";




echo "<br />";
echo "<h2>Get All Brand Details </h2>";
echo "<pre>";
print_r(@$models);
echo "</pre?";
