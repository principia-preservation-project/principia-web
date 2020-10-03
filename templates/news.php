{% extends "_layout.php" %}

{% block title %}News{% endblock %}

	{% block content %}
{% if newsid %}
	<h2>{{ news.title }}</h2>
	<p><em>Published on the {{ time }} (GMT)</em></p>
	<p>{{ news.text }}</p>

	<h2>Comments</h2>
	{{ comments(comments, 'news', news.id) }}
	<br>
{% else %}
	<h2 class="header">Latest News
		{% if userdata.powerlevel > 1 %}<a href="news.php?new">New</a>{% endif %}</h2>
	<ul>
		{% for new in news %}
			<li><a href="news.php?id={{ new.id }}">{{ new.title }}</li>
		{% else %}
			<li>No news.</li>
		{% endfor %}
	<ul>
{% endif %}
	{% endblock %}