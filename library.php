<?php 
include "core/init.php";
protected_page();
include "includes/overall/header.php"; 
	
?>
<div class="well">
  <div class="well well-wb">
  	<h3 class="well-blue"><span class="glyphicon glyphicon-book" aria-hidden="true"></span><a href=""> Online departmental Library search box </a>
    <br>
      <small><i class="glyphicon glyphicon-paperclip"></i> Departmental library search box</small>
    </h3>
  </div>

  <div class="well well-wb">
    <form action="library.php" method="POST" autocomplete="off">
      <ul>
        <li title="Search by subject, subject-code, author or publisher">
          <strong class="well-blue"><span class="fa fa-search"></span> Search Your book</strong><br>
          <input type="text" name="search" placeholder="Find books" class="form-control well-blue" <?php if(isset($_POST['search']) === true and empty($_POST['search']) === false){ 
            echo "value=".sanitize($_POST['search']); } ?> >

          <span id="float_right" title="Still we are enhansing search boundries. Very soon this section will have much more."><?php echo total_titles_of_boosks(); ?> titles</span> 
        </li>
        <br>
        <li>
          <input type="submit" name="submit" value="Search" class="btn btn-primary">
        </li>
      </ul>
      
    </form>
    
  </div>
  <span  id='float_right'>
    Man at work...<i class="fa time fa-spinner fa-pulse fa-3x fa-fw"></i>
  </span>
</div>
<?php 
    if(isset($_POST['submit']) === true)
    {
      if(isset($_POST['search']) === true and empty($_POST['search']) === true)
      {
        $errors[] = "Please type something for search.";
      }
      if(empty($errors) === false)
      {
        echo output_errors($errors);
      }
      else{

        search_books($_POST['search']);
      }
    }

 ?>




<?php include "includes/overall/footer.php";?>