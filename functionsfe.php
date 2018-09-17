<?php

function logo(){
	global $connection;
	$logosql = "SELECT * FROM settings WHERE name='logo'";
	$logores = mysqli_query($connection, $logosql);
	$logor = mysqli_fetch_assoc($logores);

	return $logor['value'];
}

function NavCat(){
	global $connection;
	$csql = "SELECT * FROM category";
	$cres = mysqli_query($connection, $csql);
	$ret = "";
	while ($cr = mysqli_fetch_assoc($cres)) {
		$ret .= '<li><a href="category.php?url=' . $cr['caturl']. '">' .$cr['name'] .'</a></li>';
	}
	return $ret;
}

function PerPageResults(){
	global $connection;
	$sql = "SELECT * FROM settings WHERE name='perpage'";
	$res = mysqli_query($connection, $sql);
	$r = mysqli_fetch_assoc($res);
	
	return $r['value'];
}

function SetCurPage(){
	if(isset($_GET['page']) & !empty($_GET['page'])){
		$curpage = $_GET['page'];
	}else{
		$curpage = 1;
	}

	return $curpage;
}

function SelPublishedContent($catid=null){
	global $connection;
	$PageSql = "SELECT * FROM content WHERE status='published'";
	if($catid){$PageSql .= " AND catid=$catid";}
	$pageres = mysqli_query($connection, $PageSql);

	return $pageres;
}

function SelPubContPag($start, $perpage, $catid=null){
	global $connection;
	$sql = "SELECT * FROM content WHERE status='published' ";
	if($catid){$sql .= " AND catid=$catid ";}
	$sql .= " LIMIT $start, $perpage";
	$res = mysqli_query($connection, $sql);

	return $res;
}

function GetCatIdName($url){
	global $connection;
	$catsql = "SELECT id,name FROM category WHERE caturl='$url'";
	$catres = mysqli_query($connection, $catsql);
	$catr = mysqli_fetch_assoc($catres);

	return $catr;
}

function GetStartEndPages($curpage, $perpage, $totalres){
	$start = ($curpage * $perpage) - $perpage;
	$end = ceil($totalres/$perpage);
	$array = array('start' => $start, 'end' => $end );

	return $array;
}

function PrintPagination($curpage, $startpage, $endpage, $previouspage, $nextpage, $url=null){

	if($url){ $urlstring = "url=$url&";}else{ $urlstring="";}
	$ret = '<nav aria-label="Page navigation">';
	$ret .= '	  <ul class="pagination">';
		    if($curpage != $startpage){ 
				$ret .= '<li><a href="?'.$urlstring.'page= $startpage" tabindex="-1" aria-label="Previous">
			        	<span aria-hidden="true">&laquo;</span>
			        	<span class="sr-only">First</span>
			      		</a>
			    		</li>';
			} 
		    if($curpage >= 2){
		    	$ret .= '<li class="page-item"><a class="page-link" href="?'.$urlstring.'page= '.$previouspage .'">'.$previouspage .'</a></li>';
		    }
		    	$ret .= '<li class="page-item active"><a class="page-link" href="?'.$urlstring.'page='.$curpage .'">'.$curpage .'</a></li>';
		    if($curpage != $endpage){
    			$ret .= '<li class="page-item"><a class="page-link" href="?'.$urlstring.'page='.$nextpage.'">'.$nextpage.'</a></li>';
			}
		    if($curpage != $endpage){
			    $ret .= '<li>
			      <a href="?'.$urlstring.'page= $endpage " aria-label="Next">
			        <span aria-hidden="true">&raquo;</span>
			        <span class="sr-only">Last</span>
			      </a>
			    </li>';
		     }
		  $ret .= '</ul>
		</nav>';

	return $ret;
}

function SelSingleArticle($url){
	global $connection;
	$sql = "SELECT * FROM content WHERE url='$url'";
	$res = mysqli_query($connection, $sql);

	return $res;
}

function InsertComments($cid){
	global $connection;
	if(isset($_POST) & !empty($_POST)){
		$name = mysqli_real_escape_string($connection, strip_tags($_POST['name']));
		$email = mysqli_real_escape_string($connection, strip_tags($_POST['email']));
		$subject = mysqli_real_escape_string($connection, nl2br(strip_tags($_POST['subject'])));

		$isql = "INSERT INTO comments (cid, name, email, subject, status) VALUES ('$cid', '$name', '$email', '$subject', 'draft')";
		$ires = mysqli_query($connection, $isql) or die(mysqli_error($connection));
		if($ires){
			$msg['success'] = "Your Comment Submitted Successfully";
			//header("location: editcontent.php?id=$lid");
		}else{
			$msg['fail'] = "Failed to Submit Your Comment";
		}

		return $msg;
	}
}

function DisplayCommentMsg($msg){
	$ret = "";
	if(isset($msg['success'])){ 

		$ret ='<div class="alert alert-success" role="alert">'. $msg['success'] .' </div>';

	}elseif(isset($msg['fail'])){ 
		$ret = '<div class="alert alert-danger" role="alert">'. $msg['fail'] .'</div>';

	}

	return $ret;
}

function DisplayComments($cid){
	global $connection;
	$comsql = "SELECT * FROM comments WHERE cid=$cid AND status='publish'";
  	$comres = mysqli_query($connection, $comsql);
  	if(mysqli_num_rows($comres)>=1){
  	$ret = '<div class="panel panel-default">
		<div class="panel-heading">Comments</div>
		  <div class="panel-body">';
		  	
		  	while($comr = mysqli_fetch_assoc($comres)){
		  		$hash = md5( strtolower( trim( $comr['email'] ) ) );
				$size = 150;
		  		$grav_url = "https://www.gravatar.com/avatar/" . $hash . "?s=" . $size;

		  	$ret .='<div class="row">
		  		<div class="col-md-3">
		  			<img src="'. $grav_url .'">
		  		</div>
		  		<div class="col-md-9">
		  			<p><strong>'. $comr['name'] .'</strong> </p>
		  			<p>'. $comr['submittime'] .'</p>
		  			<p>'. $comr['subject'] .'</p>
		  		</div>
		  	</div>
		  	<br>';
		   }
		$ret .='  </div>
		</div>';

	return $ret;
  	}
}

function SidebarComments(){
	global $connection;
	$comsql = "SELECT * FROM comments WHERE status='publish' ORDER by id DESC";
  	$comres = mysqli_query($connection, $comsql);
  	if(mysqli_num_rows($comres)>=1){
	$ret ='<div class="panel panel-default">
		<div class="panel-heading">Recent Comments</div>
		  <div class="panel-body">';
		  	while($comr = mysqli_fetch_assoc($comres)){
		  		$hash = md5( strtolower( trim( $comr['email'] ) ) );
				$size = 50;
		  		$grav_url = "https://www.gravatar.com/avatar/" . $hash . "?s=" . $size;
		  	$ret .='<div class="row">
		  		<div class="col-md-2">
		  			<img src="'. $grav_url .'">
		  		</div>
		  		<div class="col-md-10">
		  			<p><strong>'. $comr['name'] .'</strong> posted comment on '. $comr['submittime'] .'</p>
		  		</div>
		  	</div>
		  	<br>';
		}
		$ret .= ' </div>
	</div>';

	return $ret;
  	}
}

function SidebarArticles(){
	global $connection;
	$consql = "SELECT * FROM content WHERE status='published' ORDER by id DESC";
  	$conres = mysqli_query($connection, $consql);
  	if(mysqli_num_rows($conres)>=1){
		$ret ='<div class="panel panel-default">
			<div class="panel-heading">Recent Articles</div>
			  <div class="panel-body">';
			
			  	while($conr = mysqli_fetch_assoc($conres)){
			  	$ret .='<div class="row">
			  		<div class="col-md-2">
			  			<img src="admin/'. $conr['featuredimage'] .'" width="30px">
			  		</div>
			  		<div class="col-md-10">
			  			<p><strong>'. $conr['title'] .'</strong> published on '.$conr['createtime'].'</p>
			  		</div>
			  	</div>
			  	<br>';
			}
			$ret .='  </div>
		</div>';
	return $ret;
  	}
}

?>