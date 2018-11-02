<?php

$xml = new SimpleXMLElement(file_get_contents("users.xml"));

echo("List of Users:<br>");

	foreach($xml->children() as $user) {

		echo "id: ".$user->id."<br>";

		echo "email: ".$user->email."<br>";

		echo "name: ".$user->name."<br>";

		echo "gender: ".$user->gender."<br>";

		echo "address: ".$user->address."<br>";

		echo "---------------<br>";

	}

?>