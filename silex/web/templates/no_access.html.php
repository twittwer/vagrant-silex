<?php
/** Template No Access
 *
 * Show the user that he's entering the internal area without permission.
 *
 * User: Tobias Wittwer
 * Date: 25.02.2015
 * Time: 12:50
 */
?>

<div class="row">
    <div class="col-md-10 col-md-offset-1">
        <div class="jumbotron alert-danger">
            <h1>Internal Area</h1>

            <div class="pull-right jumbo-icon"><span class="glyphicon glyphicon-ban-circle" aria-hidden="true"></span>
            </div>
            <p>You have to be logged in for this page.</p>

            <p>
                <button type="button" class="btn btn-primary btn-lg" data-toggle="modal"
                        data-target="#signInModal">Sign&nbsp;in&nbsp;<span class="glyphicon glyphicon-log-in"
                                                                           aria-hidden="true"></span>
                </button>
            </p>
        </div>
    </div>
</div>