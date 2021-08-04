<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pagination System in PHP</title>
    <link rel="stylesheet" href="style.css?v=<?php echo time(); ?>">
</head>
<body>


<div class="title_box">
    <h1>Pagination System Using PHP</h1>
</div>

<table class="attendance_table">
      <thead id="table_thead">
        <tr class="table_tr">
          <th class="table_th">Roll No</th>
          <th class="table_th"> Name</th>
          <th class="table_th">Address</th>
        </tr>
      </thead>
      <tbody id="table_tbody">

<?php
        
require 'conn.php';
    
$total_student =  "SELECT * FROM `Student_detail`";
$result = mysqli_query($conn, $total_student);

$start = 0;
$per_page = 5;
$current_page = 1;

if(isset($_GET['start']))
{
  $start = $_GET['start'];
  if($start<=0)
  {
     $start=0;
     $current_page=1;
  }
  else
  {
  $current_page = $start;
  $start --;
  $start = $start * $per_page;
}
}

$total_record = mysqli_num_rows($result);
$page_no = ceil($total_record/$per_page);


$student_detail =  "SELECT * FROM `student_detail` limit $start, $per_page";
$student_result = mysqli_query($conn, $student_detail);

if(mysqli_num_rows($student_result)>0)
{
while($detail = mysqli_fetch_array($student_result))
{

?>

      <tr class="table_tr">
          <td class="table_td" data-column="Roll No"><?php echo $detail['Roll_no'];?></td>
          <td class="table_td" data-column="Name"><?php echo $detail['Name'];?></td>
          <td class="table_td" data-column="Address"><?php echo $detail['Address'];?></td>
       
         </td>
        </tr>
        </tbody>
        <?php
    }
}
else{
    echo '<div class="no_record">
    <h1 id="no_title">No records found.</h1>
    </div>
    ';
}
?>
</table>
      
<!-----------start Pagination design  ------------->
<div class="page_count">
<div class="page_container">
  <ul class="pagination">

<?php
for($i=1; $i<=$page_no; $i++ )
{
  $class = '';
  if($current_page == $i)
  {
?>
   
    <li class="active"><a href="javascript:void(0)"><?php echo $i ?></a></li>
    
    <?php
}
else
{
?>
  <li ><a href="?start=<?php echo $i ?>"><?php echo $i ?></a></li>
<?php
}
}
?>
  </ul>
</div>
</div>
<!-----------end Pagination design  ------------->

</body>
</html>