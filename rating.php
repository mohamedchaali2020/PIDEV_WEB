<?php
if (isset($_POST['save'])) {
    $conn = new mysqli('localhost', 'root' , '','pidev-2') ;
    $uID =$conn ->real_escape_string ($_POST['uID']) ;
    $ratedIndex =$conn -> real_escape_string ($_POST['ratedIndex']) ;
    $ratedIndex ++ ;
    if(!$uID) {
        $conn->query("INSERT INTO stars (rateIndex) VALUES  ('$ratedIndex')") ;
$sql =$conn ->query("SELECT id FROM stars ORDER  BY id DESC LIMIT 1") ;
$uData =$sql ->fetch_assoc() ;
        $uID =$uData['id'] ;




    }else
        $conn ->query("UPDATE stars SET rateIndex ='$ratedIndex'WHERE id='$uID'") ;
    exit(json_encode(array ('id'=> $uID)));
}

?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>rating system</title>
    <script src="https://kit.fontawesome.com/65d51a1baf.js" crossorigin="anonymous"></script>

</head>
<body>
<div align = "center" style="background: #000 ; padding: 50px ;">
    <i class="fa fa-star fa-2x"data-index="0"></i>
    <i class="fa fa-star fa-2x"data-index="1"></i>
    <i class="fa fa-star fa-2x"data-index="2"></i>
    <i class="fa fa-star fa-2x"data-index="3"></i>
    <i class="fa fa-star fa-2x"data-index="4"></i>


</div>
<script
        src="https://code.jquery.com/jquery-3.6.0.min.js"
        integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4="
        crossorigin="anonymous"></script>
<script>
    var ratedIndex =-1 ,uID =0 ;
    $(document).ready(function () {
     resetStarcolors();
     if (localStorage.getItem('ratedIndex')!= null) {
         setStars(parseInt(localStorage.getItem('ratedIndex'))) ;
         uID= localStorage.getItem('uID') ;
     }
        $('.fa-star').on('click' , function () {
            ratedIndex = parseInt($(this).data('index')) ;
            localStorage.setItem('ratedIndex',ratedIndex) ;
            saveToTheDB();
            });
      $('.fa-star').mouseover(function (){
          resetStarcolors();
          var currentIndex= parseInt($(this).data('index'));
          setStars(currentIndex) ;
          })  ;
        $('.fa-star').mouseleave(function (){
            resetStarcolors();
            if (ratedIndex != -1)
                setStars(ratedIndex) ;
        });
    });
    function saveToTheDB() {
        $.ajax( {
          url:"rating.php" ,
          method : "POST" ,
          dataType : 'json' ,
          data : {
              save :1 ,
              uID :uID ,
              ratedIndex : ratedIndex
          }  , success : function (r){
              uID=r.id;
              localStorage.setItem('uID',uID) ;
            }
            }

        );
    }
    function setStars(max) {
        for (var i=0;i<= max; i++)
            $('.fa-star:eq('+i+')').css('color', 'green');
    }
    function resetStarcolors() {
        $('.fa-star').css('color','white') ;

    }
</script>

</body>
</html>