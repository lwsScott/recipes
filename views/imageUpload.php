<!--
* Image Upload page for dating website
* uploads image
* 5/30/20
* filename https://lscott.greenriverdev.com/328/dating/views/imageUpload.php
* @author Lewis Scott
* @version 1.0
*/-->

<!DOCTYPE html>
<html lang="en">
<head>
    <title>Profile photo</title>
    <include href="includes/header.html"></include>
</head>
<body>

<include href="includes/navBar.html"></include>

<div class="container card rounded">
    <h3>Premium Members may upload a profile photo</h3>
    <p>Select a file to upload</p>
    <p>Valid file types include jpg, png and gif</p>

    <form action="#" method="post" enctype="multipart/form-data">
        <input type="file" name="fileToUpload">
        <input type="submit" value="Upload File" name="submit">
        <br>
    </form>
</div>
<div class="container card rounded">
    <form>
        <p>Proceed without submitting photo</p>
        <a href="summary" class="btn-primary float-right m-2">Next ></a>
    </form>
</div>


<!-- Optional JavaScript -->
<!-- jQuery first, then Popper.js, then Bootstrap JS -->
<script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>


</body>
</html>