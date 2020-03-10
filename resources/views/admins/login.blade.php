<form action="/notadmin/login" method="post">
<input type="email" name="email" value="" placeholder="Email" required>
<input type="password" name="password" value="" placeholder="password" required>
@csrf
<button type="submit" name="button">Submit</button>
</form>
