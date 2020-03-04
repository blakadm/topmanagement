<?php

//var_dump(Yii::$app->user->identity->ismanagement);
//var_dump(Yii::$app->user->identity->type);

//var_dump('TOP Dashboard');
//var_dump(Yii::$app->user->identity->type);
//var_dump(Yii::$app->user->identity->ismanagement);
?>

<style type="text/css">



    .icon-small + p {
        clear: left;
        margin-top: 15px;
    }

    .icon-small h4,
    .icon-small h5 {
        text-align: left;

    }

    .containerheader {
        height: 200px;
        position: relative;
        border: 3px solid green;
    }

    .vertical-center {
        margin: 0;
        position: absolute;
        top: 50%;
        -ms-transform: translateY(-50%);
        transform: translateY(-50%);
    }

    .pulse a:hover{ 
        animation: pulse 1s infinite;
        animation-timing-function: linear;   
    }

    @keyframes pulse {
        0% { transform: scale(1); }
        50% { transform: scale(1.1);
              100% { transform: scale(1); }
        }
    }





    * {
        -moz-box-sizing: border-box;
        -webkit-box-sizing: border-box;
        box-sizing: border-box;
        margin: 0;
        padding: 0;
    }

    .item {
        position: relative;


        margin: 2%;
        overflow: hidden;
        width: 540px;
    }
    .item img {
        max-width: 100%;

        -moz-transition: all 0.3s;
        -webkit-transition: all 0.3s;
        transition: all 0.3s;
    }
    .item:hover img {
        border-radius: 15px;
        box-shadow: 0 0 0 2pt #3c8dbc;
        transition: box-shadow 0.5s ease-in-out;
    }
     .item:hover h4 {
       color:#066da9;
       -webkit-transform: scale(1.05);
        -ms-transform: scale(1.05);
        transform: scale(1.2) 0.5s ease-in-out;
    }
       .item:hover p {
       color:#066da9;
      
    }
    
      .item:hover  {
   
     
        transition: box-shadow 0.5s ease-in-out;
        
         box-shadow: 0 10px 10px -2px #3c8dbc;
    }
    
   
    
    
    
    




   

</style>
<br>
<img src="/images/dashboardbanner.png" alt="" style="width: 550px;height:40px;padding-top: 0px;display: block;
  margin-left: auto;
  margin-right: auto;
  "> 
<br>
<div class="row">

    <div class="col-md-6" style="text-align: center">
        <a href="/toplevel/statistics/accomplishments" style="color:#3c8dbc">
       <div class="item" style=" float: none; margin: 0 auto;width: 90%;height: 180px;background-color: #f7f7f7">
            <br>

            <div style="margin-left: 20px;">
                
                    <span>
                        <img class src="/images/icons/samples.png" style="float: left;
                             margin-right: 10px;
                             height: 50px;
                             width: 50px;
                             color: #fff;

                             border-radius: 10%;
                             text-align: center;
                             vertical-align: middle;
                             ">
                        <div style="float: left;"><h4>RSTL Accomplishment</h4></div>
                        <div style="clear: left"> <p>Accomplishments of each RSTL based on Key Performance Indicators.</p></div>

                    </span>
            </div>
            <div class="item-overlay top"></div>
        </div>
        </a>
    </div>
    <div class="col-md-6" style="text-align: center">
 <a href="/toplevel/statistics/accomplishmentrdi" style="color:#3c8dbc">
        <div class="item" style=" float: none; margin: 0 auto;width:  90%;height: 180px;background-color: #f7f7f7">
            <br>

            <div style="margin-left: 20px;">
               
                    <span>
                        <img class src="/images/icons/samples.png" style="float: left;
                             margin-right: 10px;
                             height: 50px;
                             width: 50px;
                             color: #fff;

                             border-radius: 10%;
                             text-align: center;
                             vertical-align: middle;
                             ">
                        <div style="float: left;"><h4>RDI Accomplishment</h4></div>
                        <div style="clear: left"> <p>Accomplishment of each RDI based on Key Performance Indicators.</p></div>

                    </span>
            </div>
            <div class="item-overlay top"></div>
        </div>
     </a>
    </div>
    
    
   

</div>

<br>

<div class="row">


    <div class="col-md-4" style="text-align: center">
        <a href="/toplevel/statistics/topdata" style="color:#3c8dbc">
       <div class="item" style=" float: none; margin: 0 auto;width: 90%;height: 180px;background-color: #f7f7f7">
            <br>

            <div style="margin-left: 20px;">
                
                    <span>
                        <img class src="/images/icons/samples.png" style="float: left;
                             margin-right: 10px;
                             height: 50px;
                             width: 50px;
                             color: #fff;

                             border-radius: 10%;
                             text-align: center;
                             vertical-align: middle;
                             ">
                        <div style="float: left;"><h4>Ranking ( RSTL )</h4></div>
                        <div style="clear: left"> <p>List showing rank of RSTL's based on Key Performance Indicators.</p></div>

                    </span>
            </div>
            <div class="item-overlay top"></div>
        </div>
        </a>
    </div>
    <div class="col-md-4" style="text-align: center">
<a href="/toplevel/statistics/topdatardi" style="color:#3c8dbc">
        <div class="item" style=" float: none; margin: 0 auto;width: 90%;height: 180px;background-color: #f7f7f7">
            <br>

            <div style="margin-left: 20px;">
                
                    <span>
                        <img class src="/images/icons/samples.png" style="float: left;
                             margin-right: 10px;
                             height: 50px;
                             width: 50px;
                             color: #fff;

                             border-radius: 10%;
                             text-align: center;
                             vertical-align: middle;
                             ">
                        <div style="float: left;"><h4>Ranking( RDI's )</h4></div>
                        <div style="clear: left"> <p>List showing rank of RDI's based on Key Performance Indicators.</p></div>

                    </span>
            </div>
            <div class="item-overlay top"></div>
        </div>
    </a>
    </div>
    <div class="col-md-4" style="text-align: center">


  <a href="/toplevel/statistics/overallaccomplishment" style="color:#3c8dbc">
        <div class="item" style=" float: none; margin: 0 auto;width: 90%;height: 180px;background-color: #f7f7f7">
            <br>

            <div  style="margin-left: 20px;">
              
                    <span>
                        <img class src="/images/icons/samples.png" style="float: left;
                             margin-right: 10px;
                             height: 50px;
                             width: 50px;
                             color: #fff;

                             border-radius: 10%;
                             text-align: center;
                             vertical-align: middle;
                             ">
                        <div  style="float: left;"><h4>Overall Accomplishments and Targets</h4></div>
                        <div style="clear: left"> <p>Summary of overall accomplishments for RSTL's and RDI's.</p></div>

                    </span>
            </div>
            <div class="item-overlay top"></div>
        </div>
</a>
    </div>
    
  

</div>

<br>


<br>



