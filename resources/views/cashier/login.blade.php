<form action="/cashier/login" method="post">
<input type="text" name="username" value="" placeholder="username" required>
<input type="password" name="password" value="" placeholder="password" required>
@csrf
<button type="submit" name="button">Submit</button>
</form>
