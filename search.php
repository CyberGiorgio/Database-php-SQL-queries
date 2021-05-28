<html>
<body>
<style>
table, th, td {border: 2px solid black;}
div{
  margin: 0% 0% 0% 12%; font-size: 16px; 
}
</style>
<font size="8" face = "Verdana" color="red">
<center>Search Results<br></center>
<font face = "Verdana" color="blue" size = "4" >
<div>
<?php
//get the input box values from connect.php
$minimum = $_POST["minval"];
$maximum = $_POST["maxval"];
$prodId = $_POST["prod"];
$brand = $_POST["bra"];
$type = $_POST["typ"];
$colour = $_POST["col"];
$wild = $_POST["wil"];
echo("Minimum=  " . $minimum."<br>");
echo("Maximum= " . $maximum."<br>");
echo("Product Id=  " . $prodId."<br>");
echo("Brand= " . $brand."<br>");
echo("Type=  " . $type."<br>");
echo("Colour= " . $colour. "<br>");
echo("Wildcard= " . $wild. "<br><br>");
         //if values are empty print this message
if($minimum=="") echo("no minimum input<br>");  
if($maximum=="") echo("no maximum input<br>");
if($prodId=="") echo("no Product ID input<br>");
if($brand=="") echo("no Brand input<br>");
if($type=="") echo("no Type input<br>");
if($colour=="") echo("no Colour input<br>");
if($wild=="") echo("no Wildcard input<br>");

      //base query
$query ="SELECT * FROM product";
      // variable created to add filter easily
$zz= 0;

if($minimum != "") $zz=$zz+1;
if($maximum != "") $zz=$zz+1;
if($prodId != "") $zz=$zz+1;
if($brand != "") $zz=$zz+1;
if($type != "") $zz=$zz+1;
if($colour != "") $zz=$zz+1;
if($wild != "") $zz=$zz+1;
          //first query
if($zz >= 1) $query = $query. " WHERE";

if($maximum!= "" && $minimum!="") $query = $query. " `Price` > " .$minimum. " AND `Price` < ".$maximum;

if($minimum!= "" && $maximum=="" && $zz >=1) $query = $query. " `Price` > ".$minimum;
if($maximum!= "" && $minimum=="" && $zz >=1) $query = $query. " `Price` < ".$maximum;
if($prodId!= "" && $zz ==1) $query = $query. " `Product ID` LIKE '".$prodId."'";
if($brand!= "" && $zz ==1) $query = $query. " `Brand` LIKE '".$brand."'";
if($type!= "" && $zz ==1) $query = $query. " `Type` LIKE '".$type."'";
if($colour!= "" && $zz ==1) $query = $query. " `Colour` LIKE '".$colour."'";
if($wild!= "" && $zz ==1) $query = $query. " `Description` LIKE '%".$wild."%'";

if($maximum== "" && $minimum=="" && $zz>1)  $query = $query. " `Price` > 0 ";
      //following queries

if($zz >= 1) {

if($prodId!="" && $zz>1) $query=$query . " AND  `Product ID` LIKE '".$prodId."'";
if($brand!="" && $zz>1) $query=$query . " AND  `Brand` LIKE '".$brand."'";
if($type!="" && $zz>1) $query=$query . " AND  `Type` LIKE '".$type."'";
if($colour!="" && $zz>1) $query=$query . " AND  `Colour` LIKE '".$colour."'";
if($wild!="" && $zz>1) $query=$query . " AND  `Description` LIKE '%".$wild."%'";
}

//lets print the query to check its correct based on what is input
echo("<p>query=".$query);

include 'db_connect.php';     //connection to database
     
$result = mysqli_query($db, $query); //result will use the query to search into the database
?></div>
<center><table style="width:75% ; background-color: #F1F1F1">
<tr>
    <th>Product ID</th>
	  <th>Brand</th>
	  <th>Type</th>
    <th>Description</th>
	  <th>Colour</th>
    <th>Price</th>
    <th>Picture</th>
<tr> </center>
<?php              //if result > 0 show result
if (mysqli_num_rows($result) > 0) 
  {
  //output data of each row
  while($row = mysqli_fetch_assoc($result)) 
    {
    ?>
    <tr>
    <th><?php echo $row["Product ID"]; ?>   </th>
    <th><?php echo $row["Brand"]; ?>        </th>
	  <th><?php echo $row["Type"]; ?>         </th>
    <th><?php echo $row["Description"]; ?>  </th>
	  <th><?php echo $row["Colour"]; ?>       </th>
    <th>&pound<?php echo $row["Price"]; ?>  </th>
    <th>    <img src="<?php echo $row["Picture"]; ?>" width = 100></th>
    </tr>
    <?php
    }
} else {echo "0 results</br>";}
?>
</table>
<?php
mysqli_close($db);    //connection database closed
?>
<form action="connect.php" method="post">
<pre>
<input 
  type="submit" 
  value="Back"
  style="font-size : 40px; " 
/>
</pre>
</body>
</html>
