<?php

include "includes/header.php"; // local

?>
<div class="container">

    <div class="row">
        <div class="col s12">
            <h5 class="d_h5">Search Warrants</h5>
            <hr class="hr_title">
        </div>
        <form class="col s12">
            <div class="input-field col s12">
                <input id="first_name" type="text" class="validate">
                <label for="first_name">Full Name</label>
            </div>
            <a style="float:right" class="waves-effect waves-light btn">Search</a>
        </form>
    </div>
    <div class="row">
        <div class="col s12">
            <h5 class="d_h5">Active Warrants</h5>
            <hr class="hr_title">
        </div>
        <div>
            <table class="striped d_table">
                <thead class="d_table_head">
                    <tr>
                        <th>Criminal</th>
                        <th>Officer</th>
                        <th>Incident</th>
                        <th>Date of Issue</th>
                        <th>Expires</th>
                    </tr>
                </thead>
        
                <tbody>
                    <tr>
                        <td>Jeff Bezos</td>
                        <td>Marcel Ortiz</td>
                        <td>Evading | Joyriding | Small Willy</td>
                        <th>01-01-2001</th>
                        <th>2d 23h 27m 59s</th>
                    </tr>
                    <tr>
                        <td>Jeff Bezos</td>
                        <td>Marcel Ortiz</td>
                        <td>Evading | Joyriding | Small Willy</td>
                        <th>01-01-2001</th>
                        <th>2d 23h 27m 59s</th>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</div>