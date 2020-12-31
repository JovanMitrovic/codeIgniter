<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<title>Welcome to CodeIgniter</title>

	<!-- Latest compiled and minified CSS -->
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.0/css/bootstrap.min.css">

        <!-- Optional theme -->
        <script src="https://code.jquery.com/jquery-2.1.1.min.js"></script>

        <!-- Latest compiled and minified JavaScript -->
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.0/js/bootstrap.min.js"></script>
        
        <script src="<?php echo base_url()  ?>asset/tinymce/js/tinymce/tinymce.min.js"></script>
        <script type="text/javascript">
        tinymce.init({
            selector: "textarea",
            plugins: "link image"
         });
         
        </script>
</head>
<body>
    <div class="container">
        
        <div class="row clear_fix">
            <div class="col-md-12">
                
                <blockquote style="background: #333; color: #fff">
                <h3>Rich text editor in codeigniter</h3>
                <a href="https://www.facebook.com/TryCatchClasses/">by TryCatch Classes</a>
            </blockquote>

					<style>
                        #response{display: none}
                        div #fb, div #gp, div #tw{display: inline-block;}
                        #fb{width: 180px;}
                        #gp{width:  100px;}
                        #tw{width: 180px;}
                    </style>
					<div id="fb-root"></div>
					<script>(function(d, s, id) {
					  var js, fjs = d.getElementsByTagName(s)[0];
					  if (d.getElementById(id)) return;
					  js = d.createElement(s); js.id = id;
					  js.src = "//connect.facebook.net/en_US/sdk.js#xfbml=1&version=v2.7";
					  fjs.parentNode.insertBefore(js, fjs);
					}(document, 'script', 'facebook-jssdk'));</script>
                    <div>
                        <div id="tw">
                            <a href="https://twitter.com/trycatchclasses" class="twitter-follow-button" data-show-count="false" data-size="medium">Follow @trycatchclasses</a>
                            <script>!function(d,s,id){var js,fjs=d.getElementsByTagName(s)[0],p=/^http:/.test(d.location)?'http':'https';if(!d.getElementById(id)){js=d.createElement(s);js.id=id;js.src=p+'://platform.twitter.com/widgets.js';fjs.parentNode.insertBefore(js,fjs);}}(document, 'script', 'twitter-wjs');</script>
                        </div>
                        <div id="gp">
                            <!-- Place this tag in your head or just before your close body tag. -->
                           <script src="https://apis.google.com/js/platform.js" async defer></script>
                           <!-- Place this tag where you want the +1 button to render. -->
                           <div class="g-plusone" data-href="https://plus.google.com/+TryCatchClassesMumbai"></div>
                       </div>
					    <div id="fb">
							<div class="fb-like" data-href="https://www.facebook.com/TryCatchClasses/" data-layout="standard" data-action="like" data-size="small" data-show-faces="true" data-share="true"></div>
						</div>
                    </div>
                    
                
            </div>
        </div>
        
        <div class="row clear_fix">
            
            <div class="col-md-12">
                <form role="form" id="frmArticle" class="form" action="<?php echo base_url() ?>home/addArticle" method="POST">
                    <lablel>Title</lablel>
                    <input type="text" name="title" class="form-control">
                    <lablel>Content</lablel>
                    <textarea id="article" name="article" rows="8" class="form-control"></textarea>
                    <input class="btn btn-info btn-block" type="submit" value="Add new article" name="submit">
                </form>
                
            </div>
            
        </div>
        
        
        <div class="row clear_fix">
            
            <div class="col-md-12 response">
            </div>
            
        </div>
        
    </div>

    <script>
    $(document).ready(function(){
        loadArticle();
        $("#frmArticle").submit(function (e){
            e.preventDefault();
            tinymce.triggerSave();
            var data = $(this).serialize();
            var type = $(this).attr('method');
            var url = $(this).attr('action');
            console.log(data);
            
            $.ajax({
                url:url,
                type: type,
                data: data
            }).done(function (html){
                $('#frmArticle')[0].reset();
                loadArticle();
            });
        });
    });
    
    function loadArticle(){
        $.ajax({
                url:'<?php echo base_url() ?>home/loadArticle',
                type: 'GET'
            }).done(function (html){
                $(".response").html(html);
            });
    };
    </script>
</body>
</html>