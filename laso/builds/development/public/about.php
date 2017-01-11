<?php
$title="About";
require_once("../includes/header_login.php");

?>
<div class="main-content about">
    <div class="about-holder">
        <div class="about-content">
            <div class="row">
                <div class="col-md-3">
                    <h3 class="title">Profile</h3><hr>
                    <p>
                        Liverpool is a Mexican department store chain with coverage throughout the Country.<br><br>
The combination of an extensive retail offering, an exciting shopping experience, a sound infrastructure and focus on profitability allow us to better serve our clients and to enjoy their preference.
                    </p>
                </div>
                <div class="col-md-6">
                    <h3 class="title">Mission</h3><hr>
                    <p>
                        Founded in 1847, we are a Mexican department store chain in constant growth.<br><br>We provide families with an attention-getting and modern selection of products and services for their clothing needs and for their homes, that surpass their expectations of quality and style, all within pleasant and enjoyable surroundings.<br><br>
Liverpool’s collaborators, shareholders and suppliers all join forces to form a community in which we work together to reach our personal and professional potential, while generating high economic value, always with a sense of responsibility towards our environment.
                    </p>
                </div>
                <div class="col-md-2">
                    <h3 class="title">Vision</h3><hr>
                    <p>
                        Our goal is to be the leading department store chain with the most efficiency, growth, innovation, prestige, service, profitability and adaptation to specific markets.
                    </p>
                    <h3 class="title">Values</h3><hr>
                        <ul>
                            <li>Honesty</li>
                            <li>Quality</li>
                            <li>Equity</li>
                            <li>Teamwork</li>
                            <li>Respect</li>
                            <li>Service</li>
                            <li>Loyalty and productivity</li>
                        </ul>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- modal login -->
<div class="modal fade" id="login-modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="exampleModalLabel">Log In</h4>
            </div>
            <div class="modal-body">
                <form>
                    <div class="form-group">
                        <label for="recipient-name" class="control-label">User</label>
                        <input type="text" class="form-control" id="recipient-name">
                    </div>
                    <div class="form-group">
                        <label for="message-text" class="control-label">Password</label>
                        <input type="password" name="name" class="form-control">
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                <input type="submit" class="btn btn-primary" value="Log In">
            </div>
        </div>
    </div>
</div>
<?php require_once("../includes/footer.php"); ?>
