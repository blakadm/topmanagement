<?php

/* 
 * Project Name: Top_Management * 
 * Copyright(C)2020 Department of Science & Technology -IX * 
 * Developer: Eng'r Nolan F. Sunico  * 
 * 02 7, 20 , 3:17:29 PM * 
 * Module: _newscontent * 
 */
?>

<style type="text/css">
.imgexpand {
    transition:transform 0.25s ease;
}

.imgexpand:hover {
    -webkit-transform:scale(1.5);
    transform:scale(2);
    position: relative;
  
}
</style>


<div class="row">
                                <div style="margin-bottom: 1%;margin-left: 1%;height:30px;background-image:linear-gradient(60deg, #3c8dbc  50%,transparent 50%);">
                                    <p style='color:white;font-size:1.5rem;font-weight: bold;padding-top:.5%;padding-left: 1%'><i class="fa fa-angle-double-right" style="color:#fff;font-size:1em;margin-right: 10px"></i><?php echo date("jS F, Y", strtotime($articles->created)); ?></p>

                                </div>
                            </div>
<div id="newscontentdiv">
        
                                <div class="col-md-6">
                                    <img class="img-responsive" src="/img/articles/items/<?php echo $articles->title ?>main.jpg"/>
                                    
                                </div>
                                <div class="col-md-6">
                                    <div>
                                        <h4><?php echo $articles->introtext ?></h4>
                                    </div>
                                    <div class="category_article_content">
                                          <?php echo $articles->fulltext ?>
                                    </div>
                                </div>
                                
                            </div> 
