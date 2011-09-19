<?php


   // require("misc.php");
    require("setUpTableRequest.php");

    //using REQUEST for debug purposes
    $classTable = $_REQUEST['tableName'];
    $playerName = $_REQUEST['playerName'];

    $arrReq = array("type" => "fetchData", 
	"tableName" => $classTable);

    $reply1 = sendRequest($arrReq);

    $reply1JSON = json_decode($reply1, true);

    if($reply1JSON['type'] == 'error')
    {
	$ackArray = array("type" => "InvalidInput",
	    "message" => "Table '".$classTable."' does not exist.");	
    }
    else if($reply1JSON['result'] != null)
    {

	//Table exists

	//If the player already exists, deny permission

	$exists = false;

	for($i=0; $i< count($reply1JSON['result']['player']); $i++)
	{

		if($reply1JSON['result']['player'][$i]['name'] == $playerName)
		{
			$exists = true;
		}
	}

	if($exists)
	{
		$ackArray = array("type" => "InvalidInput",
			"message" => "A player with name ".$playerName." is already playing at table ".$classTable);
	}
	else
	{
		//Hello is valid. Set up test table and reply with ack.
		$tableName = $playerName."_".$classTable."_test";
		$nbPlayers = 3;

		// This sets up the test table. If the test table already exists, nothing will happen.
		setUpTableRequest($tableName, $nbPlayers);
	
		$ackType = "Acknowledge";
		$ackMessage = "Hello acknowledged!";
		$ackArray = array("type" => $ackType,
		    "message" => $ackMessage,
		    "testTable" => $tableName);

		//Join the table with a callbot.

		$arrJoin = array('type' => "joinTable", 
		"tableName" => $classTable,
		"playerName" => $playerName,
		"description" => "do(call, 1) :- true."
		);
	

		$reply = sendRequest($arrJoin);
    	}
    }

    $ackJSON = json_encode($ackArray);
    echo $ackJSON;

?>
