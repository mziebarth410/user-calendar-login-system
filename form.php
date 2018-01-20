<?php
	session_start();


	class Event {
		public $eventname = "";
		public $starttime = "";
		public $endtime = "";
		public $location = "";
		public $day = "";
	}

	$error_msg = "";
	$name_file = "calendar.txt";

	if(!empty($_POST))
	{
		if(isset($_POST['Clear']))
		{
			file_put_contents($name_file, "");
			header('location:calendar.php');
		}
		elseif(isset($_POST['Submit_button']))
		{
				if($error_msg == "")
				{
					$myFile = fopen($name_file, "r");
					$events = file_get_contents("calendar.txt");
					$events = json_decode($events, true);

					if(!isset($events))
					{
						$events = array();
					}

					if(!isset($events[$_POST['day']]))
					{
						$events[$_POST['day']] = array();
					}

					$newevent = new Event();

					$newevent->eventname = $_POST['eventname'];
					$newevent->starttime = $_POST['starttime'];
					$newevent->endtime = $_POST['endtime'];
					$newevent->location = $_POST['location'];
					$newevent->day = $_POST['day'];

					$index = count($events[$newevent->day]);
					$events[$_POST['day']][$index]= $newevent;

					usort($events[$_POST['day']], "compare");

					$events = json_encode($events);
					fclose($myFile);

					$myFile = fopen($name_file, "w");
					fwrite($myFile, $events);
					fclose($myfile);
					echo "test write";
					header('location:calendar.php');
					exit();
				}
		}
		else
		{
			header('location:calendar.php');
			exit();
		}
	}
	else {
		header('location:calendar.php');
		exit();
	}

	function compare($e1, $e2)
	{
			$ev1 = strtotime($e1->starttime);
			$ev2 = strtotime($e2->starttime);

			if($ev1>$ev2)
			{
					return -1;
			}
			elseif($ev1<$ev2)
			{
					return 1;
			}
			else
			{
					return 0;
			}
	}


?>
