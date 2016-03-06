<!DOCTYPE html>
<!--[if IE 9]>
<html lang="en" class="ie9"> <![endif]-->
<!--[if !IE]><!-->
<html lang="en">
<!--<![endif]-->
      <head>
      </head>
      <body> 
      <script>
      function isNumberKey(evt){
            var charCode = (evt.which) ? evt.which : event.keyCode
            if (charCode > 31 && charCode != 46 &&(charCode < 48 || charCode > 57))
                  return false;
            return true;
      }
      </script>

            <br>
            <table style="width:35%" align="center">     
                  <form action="Controller.php" method="post" id="form1" enctype="multipart/form-data">
                  <tr>
                        <td>Image :<FONT COLOR="#F00">*</FONT></td>

                        <td ><input type="file" name="image" id="fileToUpload" required="true"></td>
                  </tr>
                  <tr>
                        <td>Topic :<FONT COLOR="#F00">*</FONT></td> 
                        <td><input type="text" name="topic" size="52" required="true" style="color:black;"></td>
                  </tr>
                  <tr>
                        <td>Detail : <FONT COLOR="#F00">*</FONT><br><br><br><br></td>
                        <td><textarea rows="5" cols="50" name="detail" required="true"></textarea></td>
                  </tr>
                  <tr>
                        <td>Latitude : <FONT COLOR="#F00">*</FONT></td>
                        <td><input name="lat" type="text" size="10" required="true" onkeypress="return isNumberKey(event)"/></td>
                  </tr>
                  <tr>
                        <td>Longitude : <FONT COLOR="#F00">*</FONT></td>

                        <td><input name="long" type="text" size="10" required="true" onkeypress="return isNumberKey(event)"/></td>
                  </tr>
                  <tr>
                        <td>Tag : <FONT COLOR="#F00">*</FONT></td>


                        <td><select name="tag" required="true" onchange="this.form.submit()">
                              <option value="Thailand">Thailand</option>
                              <option value="Europe">Europe</option>
                              <option value="US">US</option>
                              <option value="Africa">Africa</option>
                              <option value="Australia">Australia</option>
                              <option value="Asia">Asia</option>                        
                        </select></td>
                  </tr>
                  <td colspan="2" align="center" >
                        <button  type="submit" form="form1" name="submit" style="color:black;">Submit</button>
                  </td>
                  </form>
            </table>  
      </body>
</html>
