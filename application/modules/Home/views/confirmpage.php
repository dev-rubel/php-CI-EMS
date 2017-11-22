<style>

    .container{padding: 0px;}
    @import url(http://fonts.googleapis.com/css?family=Nunito:300);
	body { font-family: "Nunito", sans-serif;  }
a    { text-decoration: none; }

.button
{
    text-transform: uppercase;
    letter-spacing: 2px;
    text-align: center;
    color: #0C5;
    font-size: 24px;
    font-family: "Nunito", sans-serif;
    font-weight: 300;
    margin: 5% auto;
    position: absolute;
    top: 40px;
    right: 0;
    bottom: 0;
    left: 0;
    padding: 18px 0;
    width: 415px;
    height: 55px;
    background: #1ABC9C;
    border: 1px solid #16a085;
    color: #FFF;
    overflow: hidden;
    transition: all 0.5s;
}

.button:hover, .button:active 
{
  text-decoration: none;
  color: #1ABC9C;
  border-color: #0C5;
  background: #FFF;
}

.button span 
{
  display: inline-block;
  position: relative;
  padding-right: 0;
  
  transition: padding-right 0.5s;
}

.button span:after 
{
  content: ' ';  
  position: absolute;
  top: 0;
  right: -18px;
  opacity: 0;
  width: 10px;
  height: 10px;
  margin-top: -10px;

  background: rgba(0, 0, 0, 0);
  border: 3px solid #FFF;
  border-top: none;
  border-right: none;

  transition: opacity 0.5s, top 0.5s, right 0.5s;
  transform: rotate(-45deg);
}

.button:hover span, .button:active span 
{
  padding-right: 30px;
}

.button:hover span:after, .button:active span:after 
{
  transition: opacity 0.5s, top 0.5s, right 0.5s;
  opacity: 1;
  border-color: #0C5;
  right: 0;
  top: 50%;
}

    
</style>
<?php
if(!empty($_SESSION['token_url'])):
?>

<div class="container box-form">
        <div class="col-md-8 col-md-offset-2">
            <?php echo flash_msg();?>
            <div class="text-center" style="padding: 70px 0px;">
                <a href="<?php echo $_SESSION['token_url'];?>" target="_blank" class="button" >
                <span>Click to download pdf.</span>
                </a>
            </div>
        </div>
    </div>

<?php else:?>

<div class="container box-form">
        <div class="col-md-8 col-md-offset-2">
            <div class="text-center" style="padding: 50px 0px;">
                <h1>No Token Found</h1>
            </div>
        </div>
    </div>

<?php endif; ?>
