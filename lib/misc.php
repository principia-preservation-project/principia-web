<?php

/**
 * Returns true if it is executed from the command-line. (For command-line tools)
 */
function isCli() {
	return php_sapi_name() == "cli";
}

function register($name, $pass, $mail, $sendWelcomeEmail = true) {
	$token = bin2hex(random_bytes(20));
	query("INSERT INTO users (name, password, email, token, joined) VALUES (?,?,?,?,?)",
		[$name,password_hash($pass, PASSWORD_DEFAULT), $mail, $token, time()]);

	if ($sendWelcomeEmail) {
		sendMail($mail, 'Welcome to principia-web!', sprintf(<<<HTML
				<p><b>Welcome to principia-web, %s!<b></p>

				<p>Principia-web is an unofficial community site replacement for the game Principia, as the official community site was shut down in early 2018.
				Feel free to upload some cool levels!</p>

				<p><em>This is an automated email, sent to you since you registered an account on principia-web.</em></p>
HTML
		, $name));
	}

	return $token;
}

/**
 * Get hash of latest git commit
 *
 * @param bool $trim Trim the hash to the first 7 characters
 * @return void
 */
function gitCommit($trim = true) {
	$commit = file_get_contents('.git/refs/heads/master');

	if ($trim)
		return substr($commit, 0, 7);
	else
		return rtrim($commit);
}
