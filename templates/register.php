{% extends "_layout.php" %}

{% block title %}Register{% endblock %}

	{% block content %}
<div class="header_message">{{ error }}</div>

<h2>Register</h2>

<form class="reglog" method="POST">
	<p>
		<span>Username:</span>
		<input type="text" name="name" size="25" maxlength="25">
	</p><p>
		<span>Email:</span>
		<input type="text" name="mail" size="25">
	</p>

	<p>
		<span>Password:</span>
		<input type="password" name="pass" size="25" maxlength="32">
	</p><p>
		<span>Password again:</span>
		<input type="password" name="pass2" size="25" maxlength="32">
	</p>

	<p><input type="submit" class="submit" name="action" value="Register"></p>
</form>
	{% endblock %}