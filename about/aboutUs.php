<html>
<body>
<form action="aboutUsData.php" method="post">
Name: <input type="text" name="name" value="" />

Address: <input type="text" name="address" value="" />

Postalcode: <input type="text" name="postalId" value="" />

Phone: <input type="text" name="phone" value="" />

Email: <input type="text" name="email" value="" />

Company description: <textarea type="text" name="description" value="<?php $companyDesc;?>"></textarea>
<input type="submit" id="submit" name="submit" value="Send">
</form>
</body>
</html>

