<!-- modal login -->
<div class="modal fade" id="login-modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="exampleModalLabel">Log In</h4>
            </div>
            <div class="modal-body">
                <form id="login" method="post" action="liverpool.php">
                    <div class="form-group">
                        <label for="recipient-name" class="control-label">User</label>
                        <input type="text" name="username" class="form-control" id="user-input">
                    </div>
                    <div class="form-group">
                        <label for="message-text" class="control-label">Password</label>
                        <input type="password" name="password" id="pass-input" class="form-control">
                    </div>
                    <div class="col-md-8 col-md-offset-2">
                        <div class="error-message" style="display:none">
                            <span><p class="text-center"></p></span>
                        </div>
                    </div>
            </div><br>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                <input type="submit" class="btn btn-primary" name="submit" value="Log in">
            </form>
            </div>
        </div>
    </div>
</div>
<footer class="footer text-muted">
    <div class="container">
        <p class="text-center">
            Liverpool Asian Sourcing office
        </p>
        <div class="row">
            <div class="col-md-2">
                <h4>About Liverpool</h4>
                <ul>
                    <li><a href="about">About</a></li>
                    <li><a href="history">History</a></li>
                    <li><a href="presence">Geographical Presence</a></li>
                </ul>
            </div>
            <div class="col-md-2">
                <h4>Investors</h4>
                <ul>
                    <li><a href="investors">Financial information</a></li>
                </ul>
            </div>
            <div class="col-md-2">
                <h4>LASO</h4>
                <ul>
                    <li><a href="laso">Liverpool Asian Sourcing Office</a></li>
                </ul>
            </div>
            <div class="col-md-4 col-md-offset-2">
                <ul class="socialmedia-widget social-share">
                        <li class="facebook"><a href="https://www.facebook.com/liverpoolmexico" target="_blank" title="Facebook">Facebook</a></li>
                        <li class="twitter"><a href="https://twitter.com/liverpoolmexico" target="_blank" title="Twitter">Tweet</a></li>
                        <li class="pinterest"><a href="http://pinterest.com/liverpoolmexico/pins/" target="_blank" title="Pinterest">Pinterest</a></li>
                    </ul>
                    <p class="home-principal"><a href="http://www.liverpool.com.mx" target="_blank" title="http://www.liverpool.com.mx">www.liverpool.com.mx</a></p>
            </div>
        </div>
    </div>
</footer>
</body>

</html>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>
<script type="text/javascript" src="js/bootstrap.min.js"></script>
<script type="text/javascript">
    $(function(){
        //navbar
        $('.dropdown').hover(function(){
            $(this).children('.dropdown-content').show("fast");
        }, function(){
            $(this).children('.dropdown-content').hide();
        });
        $('#login').submit(function(e){
            var userInput=$('#user-input').val().trim(),
                passInput=$('#pass-input').val().trim();
            if(userInput=="" || passInput==""){
                console.log("empty");
                e.preventDefault();
                $('.error-message').show("fast");
                $('.error-message span p').html("Please fill these fields");
                return false;
            } else{
                $.ajax({
                    type:"POST",
                    url:"main_login.php",
                    data:{u:userInput,p:passInput},
                    async:false,
                    success:
                        function(response){
                            console.log(response);
                            if(response=="false"){
                                e.preventDefault();
                                $('.error-message span p').html("Username/password incorrect");
                                $('.error-message').show("fast");
                            }
                            else if(response=="true"){
                                return true;
                            }
                        }
                });
            }
        });
    });
</script>
