<?php

use yii\widgets\Pjax;
use app\models\Post;
/* @var $this yii\web\View */
use yii\helpers\Html;
use yii\grid\GridView;
use yii\helpers\StringHelper;
use app\models\Agency;
use cinghie\articles\models\ItemsGlobalSearch;

$this->title = 'News Feed';

$searchModel = new ItemsGlobalSearch();
$searchModel->state = 1;
if (Yii::$app->request->queryParams == '') {
    $Param = "";
} else {
    $Param = Yii::$app->request->queryParams;
}
$dataProvider = $searchModel->search($Param);
?>

<?php
/* @var $this yii\web\View */


$Agencies = Agency::find()->orderBy(['agency_name' => SORT_ASC])->all();
$SQL = "SELECT `agency_name` AS `name`,`website`, `description`, `membertypeid`,`address`,`geo_location`,`contact`
FROM `tbl_agency` WHERE `membertypeid`=1 GROUP BY `r_id` ORDER BY `r_id`";
$Connection = Yii::$app->db;
$Command = $Connection->createCommand($SQL);
$mAgencies = $Command->queryAll();


$sql = "Select * from tbl_article_items";
$cmd = $Connection->createCommand($SQL);  
$queryArticles = $cmd->queryAll();

$ArticlesList = app\models\ArticleItems::find()->orderBy(['created' => SORT_DESC])->all();
//->orderBy(])
//echo \yii\helpers\Json::encode($ArticlesList);
?>

<link rel="stylesheet" href="/owlcarousel/assets/owlcarousel/assets/owl.carousel.min.css">
<link rel="stylesheet" href="/owlcarousel/assets/owlcarousel/assets/owl.theme.default.min.css">

<style type="text/css">
    .onelab-content
    {
        max-height: 1500px;
    }

    .owl-carousel .owl-wrapper {
        display: flex !important;
    }
    .owl-carousel .owl-item img {
        width: 100%;
        height: 100%;
        object-fit: cover;
        max-width: initial;
    }

    .owl-carousel {
        background-color: #024a74 !important;
    }


    .owl-carousel .nav-btn{
    height: 47px;
    position: absolute;
    width: 26px;
    cursor: pointer;
    top: 100px !important;
    }

    .owl-carousel .owl-prev.disabled,
    .owl-carousel .owl-next.disabled{
    pointer-events: none;
    opacity: 0.2;
    }

    .owl-carousel .prev-slide{
    background: url(nav-icon.png) no-repeat scroll 0 0;
    left: -33px;
    }
    .owl-carousel .next-slide{
    background: url(nav-icon.png) no-repeat scroll -24px 0px;
    right: -33px;
    }
    .owl-carousel .prev-slide:hover{
    background-position: 0px -53px;
    }
    .owl-carousel .next-slide:hover{
    background-position: -24px -53px;
    }   

    element {

    }
    .theme1 {

        position: absolute;
        bottom: 1vh;
        left: 1%;
        right: 0;
        margin-left: 3%;
        color:#fff;
        font: bold 17px PT Sans Caption, sans-serif;
        z-index: 3;

        text-shadow: 0px 2px 3px
            rgba(0,0,0,0.7);

    }

    .category_article_content {
        margin-top: 20px;
        font-size: 15px;
    }
   
        .media-object {
       display: block;
   }

        .nav-pills > li.active > a, .nav-pills > li.active > a:hover, .nav-pills > li.active > a:focus {
            border-top-color: none;
       }
        ul.cap-meta {
          margin: 0;
          padding: 0;
        }
        .cap-date {
          background: #0277bd;
          color: #fff;
          font-size: 10px;
          text-transform: uppercase;
          float: left;
          text-shadow: none;
          height: 20px;
          padding:5px;
        }

        .cap-date:before {
          content: "\f017";
          font-family: FontAwesome;
          font-size: 11px;
          margin-right: 4px;
          font-style: normal;
          font-weight: normal;
        }
        
        .corner-top-right-bevel {
  border-color:  transparent transparent # transparent;
  border-width: 0 100px 100px 0;
}

hr.thin {
height: 1px;
border: 0;
color: #333;
background-color: #333;

}
</style>


<script src="/owlcarousel/assets/owlcarousel/owl.carousel.js"></script>

<script type="text/javascript">
    $(document).ready(function () {
        $('.owl-carousel').owlCarousel({
            loop: true,
            margin: 10,
            responsiveClass: true,
            navText:["<div class='nav-btn prev-slide'></div>","<div class='nav-btn next-slide'></div>"],
         //   autoWidth:true,
            responsive: {
                0: {
                    items: 1,
                    nav: true
                },
                600: {
                    items: 2,
                    nav: true
                },
                1000: {
                    items: 2,
                    nav: true,
                    loop: true
                }
            }
        })
        
       
            $(".divclick a").click(function(e) {
                
                let dataval = $(this).data('value');
        //       alert(dataval);
                
                e.preventDefault();
                $.ajax({
                    type: "GET",
                    url: "/portal/newscontent",
                    data: { 
                        articletitle: dataval, // < note use of 'this' here
                     //   access_token: $("#access_token").val() 
                    },
                    success: function(data, textStatus, jqXHR) {
                   //     alert('ok');
                        var x = document.getElementById('divReplaceContent');
                        x.scrollIntoView();
                    
                          $('#divReplaceContent').html(data);
                      
                    },
                    error: function(result) {
                   //  alert(result);
                    }
                });
              
            });
            
             $(".divothernews a").click(function(e) {
                
                let dataval = $(this).data('value');
        //       alert(dataval);
                
                e.preventDefault();
                $.ajax({
                    type: "GET",
                    url: "/portal/newscontent",
                    data: { 
                        articletitle: dataval, // < note use of 'this' here
                     //   access_token: $("#access_token").val() 
                    },
                    success: function(data, textStatus, jqXHR) {
                   //     alert('ok');
                          $('#divReplaceContent').html(data)
                          var x = document.getElementById('divReplaceContent');
                            x.scrollIntoView();
                    },
                    error: function(result) {
                     alert(result);
                    }
                });
            });
    
    });
</script>
<script type="text/javascript">
    //$('.divclick a').click(function(e) 
 
    function swapcontent(obj)
    {
      //  alert(obj);
       // e.preventDefault();
      //  alert('here in');
       //  var divId = 'summary' +$(this).attr('id');
     
      //  Request::find()->where(['request_id' => $model->request_id])->one();
       $('#newscontentdiv').empty();
       var divContent = '<div class="col-md-6"><img class="img-responsive" src="/img/articles/items/main.jpg" />';
       divContent = divContent + '</div><div class="col-md-6"><div><h4>Swapped Contents</h4></div>';
       divContent = divContent + '<div class="category_article_content">Swapped Content' + obj + '</div> </div>';
    //  divContent = divContent + 'Title is : ' + obj;
     $(divContent).appendTo('#newscontentdiv'); 
     //document.getElementById('#newscontentdiv')
      <?php
   // $newarticles = app\models\ArticleItems::find()->where(['title'=>'crafting'])->one();   
    echo 'hello '; //. $newarticles->title;
    ?>
    };
    </script>
<?php 
$articles = app\models\ArticleItems::find()->where(['title'=>'crafting'])->one();   


?>

<section>
    <div  style="width: 100%;float: left;">
        <div class="row">
           
            <div class="large-2 columns">
            <div class="carousel-wrap">
                <div class="owl-carousel owl-theme">
                            <?php

                            $i = 0;
                            foreach ($ArticlesList as $articlerec) 
                            {
                                 if ($i == 4) { break; }
                                   echo '<div style="padding-left: 1%;">';
                                   echo '<figure>';
                                              echo '<img src="/img/articles/items/' . $articlerec->title . 'main.jpg" style=" width: 800px; height: 400px;object-fit: cover;">';
                                                echo '<figcaption class="theme1">';
                                                      echo '<ul class="cap-meta"><li class="cap-date">'. date("jS F, Y", strtotime($articlerec->created)) . '</li></ul>';
                                                      echo '<br>';
                                                    //  echo $articlerec->introtext . "<div  class='divclick' style='position: relative;margin-right: 20px; font-size:1.3rem'><a onclick=swapcontent('" . $articlerec->title  . "') href='#' tabindex='-1'>Read more</a></div>";
                                                  //    echo ;
                                                        echo $articlerec->introtext . "<div  class='divclick' style='position: relative;margin-right: 20px; font-size:1.3rem'><a id='areadmore' href='#' data-value='".  $articlerec->title ."' tabindex='-1'>Read more</a></div>";

                                              echo '</figcaption>';
                                            echo '</figure>';
                                       echo '</div>';
                                        $i++;
                             }
                            ?>
                </div>
            </div>
            </div>
        </div>
    </div>
</section>   


<section>
    <div class="content-wrapper">
        <div class="row" style="padding:2%">


            <div class="body_main_bg">
                <div class="container">
                    
                    <div class="col-xs-8 col-md-8">
                        <br>
                        <div class="row">
                            <div class="focusdiv" id="divReplaceContent" name="divReplaceContent" tabindex="-1">
                                    <?php Pjax::begin(); ?>
                                     <?php
                                                  echo $this->render('_newscontent', ['articles'=>$articles]);
                                       ?>
                                    <?php Pjax::end(); ?>
                            </div>
                        </div>
                    </div>  
                    <div class="col-xs-4 col-md-4">
                        <div class="widget_title widget_black">
                                <h4>Other News</h4>
                                
                            </div>
                      <div  style="max-width: 400px;max-height: 350px;overflow-x: hidden;overflow-y: auto;scrollbar-color: #066da9 #fff;scrollbar-width:thin;">
                            <div class="widget">
                            
                         <?php
                            foreach ($ArticlesList as $articlerec) 
                            {
                                 echo '<div class="row" style="margin:3px"><div class="col-md-4">';
                                 echo '<img class="img-responsive" src="/img/articles/items/' . $articlerec->title . 'main.jpg" alt="Generic placeholder image"></img></div>';
                                 echo '<div class="col-md-8">';
                                 echo "<div class='divothernews'><a id='aothernews' class='abrackets' href='#' data-value='" .  $articlerec->title   . "'>";
                                 echo $articlerec->introtext;
                                 echo '</a>';
                               echo '</div></div></div>';

                            }
                        ?>
<!--                            <p class="widget_divider"><a href="#" target="_self">More News&nbsp;»</a></p>-->
                        </div>
                      </div>
                    </div>   
                </div>


            </div>
        </div>
    </div>










</section>


<div>
      
</div>







