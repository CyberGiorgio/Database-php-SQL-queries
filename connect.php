<font color="blue">
<font face = "Verdana" size = "8">
<center><p>Welcome to Rockland</p>
<style>
p{
  color: red;
}

table, th, td {border: 2px solid #9B9A9A;}
</style>



<!-- add a search button -->
<form  action="search.php" method="post" style="text-align: left; margin-left: 10%; font-size: 28px">
Minimum Price: <input type="text" name="minval" ><br>   
Maximum Price: <input type="text" name="maxval" ><br>

Product ID: <select name="prod"> 
<option value=""> Select...</option>
<option value="101"> 101</option>
<option value="102"> 102</option>
<option value="120"> 120</option>
<option value="121"> 121</option>
<option value="122"> 122</option>
<option value="200"> 200</option>
<option value="220"> 220</option>
<option value="300"> 300</option>
<option value="320"> 320</option>
<option value="330"> 330</option>
</select><br>

Colour: <select name="col"> 
<option value=""> Select...</option>
<option value="Brown"> Brown</option>
<option value="Beige"> Beige</option>
<option value="Chrome"> Chrome</option>
<option value="Gold"> Gold</option>
<option value="Pink"> Pink</option>
<option value="White"> White</option>
<option value="White & Black"> White & Black</option>
<option value="Yellow"> Yellow</option>
</select><br>

Brand: <select name="bra"> 
<option value=""> Select...</option>
<option value="Fender"> Fender</option>
<option value="DiMarzio"> DiMarzio</option>
<option value="Gibson"> Gibson</option>
<option value="Ibanez"> Ibanez</option>
</select><br>

Type: <select name="typ"> 
<option value=""> Select...</option>
<option value="Pickups"> Pickups</option>
<option value="Bridge"> Bridge</option>
<option value="Neck"> Neck</option>
</select><br>

Wild: <input type="text" name="wil" ><br>

<input 
  type="submit" 
  value="Search"
  style="font-size : 28px; 
  margin: 1% 1% 0% 40.3%;" 
>
</form>

<!-- add a back button -->
<form action="index.php" method="get">
<input 
  type="submit" 
  value="Back"
  style="font-size : 28px; 
      margin-bottom: 1%;
      " 
      >


<?php
include 'db_connect.php';			//connection to the database
//here is the basic query
$query="SELECT * FROM product";
$result = mysqli_query($db, $query);		//result will use the query to search into the database
?>

<table style="width:80%; margin:0.7% 3% 5% 3%; background-color: #F1F1F1">
  <tr>
    <th>Product ID</th>
	  <th>Brand</th>
   	<th>Type</th>
    <th>Description</th>
	  <th>Colour</th>
    <th>Price</th>
    <th>Picture</th>
<tr>
<?php
if (mysqli_num_rows($result) > 0) 				//if result > 0 show result
  {
  //output data of each row
  while($row = mysqli_fetch_assoc($result)) 
    {
    ?>
    <tr>
    <th><?php echo $row["Product ID"]; ?>       </th>
	  <th><?php echo $row["Brand"]; ?>            </th>
	  <th><?php echo $row["Type"]; ?>             </th>
    <th><?php echo $row["Description"]; ?>      </th>
	  <th><?php echo $row["Colour"]; ?>           </th>
    <th>&pound<?php echo $row["Price"]; ?>      </th>
    <th><img src="<?php echo $row["Picture"]; ?>" width=100></th>
    </tr>
    <?php
    }
} else {echo "0 results</br>";}
?>
</table>
<?php
mysqli_close($db);			//close connection database
?>