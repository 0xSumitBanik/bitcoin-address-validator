<html>
<body class="custom-background">
<div class="container formStyle">
    <p style="font-weight:320;font-size:28px;">Bitcoin Address Validator</p>
    <form method="POST" class="col-sm-12">
        <input id="addressInput" type="text" name="address"
         value="<?php echo isset($_POST['address']) ? $_POST['address'] : '' ?>" required/>
        <br/>
        <button class="btn waves-effect waves-light" id="customButton" onkeyup="validCheck()"
         type="submit" name="submit">Check Validity
        </button>
        <div id="custom-card-panel">
            <?php if(isset($message))
            {
            ?> <span id="valid-or-not"> <?= $message?></span>
           <?php } ?>
        </div>
        
    </form>
<br/>
    <?php include 'footer.php'?>
</div>
        </body>
        </html>
