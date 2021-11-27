<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Upload Profile Picture</title>
</head>
<body>
    
    <form  enctype="multipart/form-data" method="POST" action="includes/uploadProfilePicture.php" class="p-12">
        <h2 class="text-3xl">Upload Profile Picture</h2>
        <input name="file" type="file"/><br>
        <input class="btn bg-green-500 mt-2" type="submit" name="submit" value="Upload"/>
    </form>

    

</body>
</html>